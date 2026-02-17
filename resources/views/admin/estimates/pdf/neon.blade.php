<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Estimate {{ $estimate->estimate_number }}</title>

<style>
body{
    font-family: DejaVu Sans, sans-serif;
    margin:0;
    background:#000000;
    color:#d1d5db;
    font-size:12px;
}

.wrapper{
    padding:25px;
}

.card{
    background:#111827;
    border:1px solid #06b6d4;
    border-radius:8px;
    overflow:hidden;
}

/* HEADER */
.header{
    padding:25px;
    border-bottom:1px solid #0891b2;
}

.header table{
    width:100%;
}

.company-name{
    color:#22d3ee;
    font-weight:bold;
    text-transform:uppercase;
    letter-spacing:1px;
    font-size:15px;
}

.header-right{
    text-align:right;
    font-size:11px;
    line-height:16px;
    color:#9ca3af;
}

/* SECTION */
.section{
    padding:25px;
    border-bottom:1px solid #0e7490;
}

.bill-title{
    color:#22d3ee;
    text-transform:uppercase;
    font-weight:bold;
    font-size:11px;
    letter-spacing:2px;
}

.info-box{
    background:#1f2937;
    border:1px solid #06b6d4;
    padding:12px;
    border-radius:6px;
    font-size:11px;
}

.info-box table{
    width:100%;
}

table.main{
    width:100%;
    border-collapse:collapse;
    font-size:11px;
}

table.main th{
    background:#06b6d4;
    color:#000000;
    padding:8px;
    border:1px solid #0891b2;
    text-align:left;
}

table.main td{
    padding:8px;
    border:1px solid #0e7490;
}

.text-right{
    text-align:right;
}

.highlight{
    color:#22d3ee;
    font-weight:bold;
}

.summary{
    width:260px;
    float:right;
}

.summary table{
    width:100%;
}

.total{
    border-top:1px solid #06b6d4;
    padding-top:8px;
    font-size:16px;
    font-weight:bold;
    color:#22d3ee;
}

.notes{
    padding:25px;
}

.notes-title{
    text-transform:uppercase;
    font-weight:bold;
    font-size:11px;
    letter-spacing:2px;
    color:#22d3ee;
}
</style>
</head>

<body>

<div class="wrapper">
<div class="card">

    {{-- HEADER --}}
    <div class="header">
        <table>
            <tr>
                <td width="60%">
                    @if($setting->company_logo)
                        <img src="{{ public_path('storage/'.$setting->company_logo) }}"
                             style="height:45px; background:white; padding:4px; border-radius:4px;"><br><br>
                    @endif

                    <div class="company-name">
                        {{ $setting->company_name }}
                    </div>
                </td>

                <td width="40%" class="header-right">
                    <strong style="color:#22d3ee;">
                        {{ $setting->company_name }}
                    </strong><br>
                    {{ $setting->company_address }}<br>
                    {{ $setting->company_email }}<br>
                    {{ $setting->company_phone }}
                </td>
            </tr>
        </table>
    </div>


    {{-- CLIENT + ESTIMATE --}}
    <div class="section">
        <table width="100%">
            <tr>
                <td width="55%" valign="top">

                    <div class="bill-title">
                        Bill To
                    </div><br>

                    <strong style="color:#ffffff; font-size:14px;">
                        {{ $estimate->client->name }}
                    </strong><br>

                    {{ $estimate->client->address }}<br>
                    {{ $estimate->client->email }}<br>
                    {{ $estimate->client->phone }}

                </td>

                <td width="45%" valign="top" align="right">

                    <div class="info-box">

                        <table>
                            <tr>
                                <td style="color:#9ca3af;">Estimate #</td>
                                <td class="text-right highlight">
                                    {{ $estimate->estimate_number }}
                                </td>
                            </tr>

                            <tr>
                                <td style="color:#9ca3af;">Issue Date</td>
                                <td class="text-right">
                                    {{ $estimate->issue_date }}
                                </td>
                            </tr>

                            <tr>
                                <td style="color:#9ca3af;">Expiry Date</td>
                                <td class="text-right">
                                    {{ $estimate->expiry_date ?? '-' }}
                                </td>
                            </tr>
                        </table>

                        <div style="border-top:1px solid #06b6d4; margin-top:8px; padding-top:8px; text-align:right;">
                            <small style="color:#9ca3af;">Grand Total</small><br>
                            <strong style="font-size:18px; color:#22d3ee;">
                                ₹ {{ number_format($estimate->total,2) }}
                            </strong>
                        </div>

                    </div>

                </td>
            </tr>
        </table>
    </div>


    {{-- TABLE --}}
    <div class="section">
        <table class="main">
            <thead>
                <tr>
                    <th>Services</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Rate</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>

            <tbody>
                @foreach($estimate->items as $item)
                <tr>
                    <td>
                        <strong style="color:#ffffff;">
                            {{ $item->title }}
                        </strong><br>
                        <small style="color:#6b7280;">
                            {{ $item->description }}
                        </small>
                    </td>

                    <td class="text-right">
                        {{ $item->quantity }}
                    </td>

                    <td class="text-right">
                        ₹ {{ number_format($item->rate,2) }}
                    </td>

                    <td class="text-right highlight">
                        ₹ {{ number_format($item->amount,2) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    {{-- SUMMARY --}}
    <div class="section" style="border-bottom:none;">

        <div class="summary">
            <table>
                <tr>
                    <td style="color:#9ca3af;">Subtotal</td>
                    <td class="text-right">
                        ₹ {{ number_format($estimate->subtotal,2) }}
                    </td>
                </tr>

                <tr>
                    <td style="color:#9ca3af;">
                        Tax ({{ $estimate->tax_percentage }}%)
                    </td>
                    <td class="text-right">
                        ₹ {{ number_format($estimate->tax_amount,2) }}
                    </td>
                </tr>

                <tr>
                    <td colspan="2" class="total">
                        <table width="100%">
                            <tr>
                                <td>Total</td>
                                <td align="right">
                                    ₹ {{ number_format($estimate->total,2) }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <div style="clear:both;"></div>
    </div>


    {{-- NOTES --}}
    @if($estimate->notes)
    <div class="notes">
        <div class="notes-title">
            Notes
        </div><br>

        {{ $estimate->notes }}
    </div>
    @endif

</div>
</div>

</body>
</html>
