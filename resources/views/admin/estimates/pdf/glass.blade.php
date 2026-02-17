<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Estimate {{ $estimate->estimate_number }}</title>

<style>
body{
    font-family: DejaVu Sans, sans-serif;
    margin:0;
    font-size:12px;
    color:#374151;
    background: linear-gradient(135deg,#e0e7ff,#f3e8ff,#ffe4e6);
}

.wrapper{
    padding:30px;
}

.card{
    background:#ffffff;
    border:1px solid #e5e7eb;
    border-radius:10px;
    overflow:hidden;
}

/* HEADER */
.header{
    padding:25px;
    border-bottom:1px solid #e5e7eb;
}

.header table{
    width:100%;
}

.company-name{
    font-size:15px;
    font-weight:bold;
    text-transform:uppercase;
    letter-spacing:1px;
    color:#111827;
}

.header-right{
    text-align:right;
    font-size:11px;
    line-height:16px;
    color:#374151;
}

/* SECTION */
.section{
    padding:25px;
    border-bottom:1px solid #e5e7eb;
}

.bill-title{
    text-transform:uppercase;
    font-size:11px;
    font-weight:bold;
    letter-spacing:2px;
    color:#374151;
}

.info-box{
    background:#f9fafb;
    border:1px solid #e5e7eb;
    padding:14px;
    border-radius:8px;
    font-size:11px;
}

.info-box table{
    width:100%;
}

table.main{
    width:100%;
    border-collapse:collapse;
    font-size:11px;
    background:#fdfdfd;
}

table.main th{
    background:#f3f4f6;
    padding:8px;
    border:1px solid #e5e7eb;
    text-align:left;
    font-weight:600;
    color:#374151;
}

table.main td{
    padding:8px;
    border:1px solid #e5e7eb;
}

.text-right{
    text-align:right;
}

.highlight{
    color:#4f46e5;
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
    border-top:1px solid #d1d5db;
    padding-top:8px;
    font-size:16px;
    font-weight:bold;
    color:#4f46e5;
}

.notes{
    padding:25px;
}

.notes-title{
    text-transform:uppercase;
    font-weight:bold;
    font-size:11px;
    letter-spacing:2px;
    color:#374151;
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
                             style="height:45px; background:white; padding:5px; border-radius:6px;"><br><br>
                    @endif

                    <div class="company-name">
                        {{ $setting->company_name }}
                    </div>
                </td>

                <td width="40%" class="header-right">
                    <strong>{{ $setting->company_name }}</strong><br>
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

                    <div class="bill-title">Bill To</div><br>

                    <strong style="font-size:14px; color:#111827;">
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
                                <td>Estimate #</td>
                                <td class="text-right highlight">
                                    {{ $estimate->estimate_number }}
                                </td>
                            </tr>

                            <tr>
                                <td>Issue Date</td>
                                <td class="text-right">
                                    {{ $estimate->issue_date }}
                                </td>
                            </tr>

                            <tr>
                                <td>Expiry Date</td>
                                <td class="text-right">
                                    {{ $estimate->expiry_date ?? '-' }}
                                </td>
                            </tr>
                        </table>

                        <div style="border-top:1px solid #e5e7eb; margin-top:8px; padding-top:8px; text-align:right;">
                            <small>Grand Total</small><br>
                            <strong style="font-size:18px; color:#4f46e5;">
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
                        <strong style="color:#111827;">
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
                    <td>Subtotal</td>
                    <td class="text-right">
                        ₹ {{ number_format($estimate->subtotal,2) }}
                    </td>
                </tr>

                <tr>
                    <td>
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
        <div class="notes-title">Notes</div><br>
        {{ $estimate->notes }}
    </div>
    @endif

</div>
</div>

</body>
</html>
