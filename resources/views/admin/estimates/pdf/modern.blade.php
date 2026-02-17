<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Estimate {{ $estimate->estimate_number }}</title>

<style>
body{
    font-family: DejaVu Sans, sans-serif;
    margin:0;
    background:#f3f4f6;
    font-size:12px;
    color:#374151;
}

.wrapper{
    padding:25px;
}

.card{
    background:#ffffff;
    border-radius:6px;
    overflow:hidden;
}

/* HEADER (Gradient not supported, so solid purple) */
.header{
    background:#6d28d9; /* purple-700 */
    color:#ffffff;
    padding:25px;
}

.header table{
    width:100%;
}

.header td{
    vertical-align:top;
}

.logo{
    height:45px;
    background:#ffffff;
    padding:4px;
    border-radius:5px;
}

/* SECTION */
.section{
    padding:25px;
    border-bottom:1px solid #e5e7eb;
}

.info-box{
    background:#f9fafb;
    padding:12px;
    border-radius:6px;
    font-size:11px;
}

table{
    width:100%;
    border-collapse:collapse;
    font-size:11px;
}

table th{
    background:#f3f4f6;
    padding:8px;
    text-align:left;
    font-weight:bold;
    color:#374151;
}

table td{
    padding:8px;
    border-bottom:1px solid #e5e7eb;
}

.text-right{
    text-align:right;
}

.summary{
    width:260px;
    float:right;
}

.summary table{
    width:100%;
}

.summary td{
    padding:5px 0;
}

.total{
    border-top:1px solid #e5e7eb;
    padding-top:8px;
    font-weight:bold;
    font-size:16px;
    color:#6d28d9;
}

.notes{
    padding:25px;
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
                             class="logo"><br><br>
                    @endif

                    <strong style="font-size:15px;">
                        {{ $setting->company_name }}
                    </strong><br>
                    <span style="font-size:11px;">
                        Estimate Document
                    </span>
                </td>

                <td width="40%" align="right" style="font-size:11px; line-height:16px;">
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

                    <strong style="text-transform:uppercase; font-size:11px; color:#6b7280;">
                        Bill To
                    </strong><br><br>

                    <strong style="font-size:14px;">
                        {{ $estimate->client->name }}
                    </strong><br>

                    {{ $estimate->client->address }}<br>
                    {{ $estimate->client->email }}<br>
                    {{ $estimate->client->phone }}

                </td>

                <td width="45%" valign="top" align="right">

                    <div class="info-box">
                        <table width="100%">
                            <tr>
                                <td>Estimate #</td>
                                <td align="right"><strong>{{ $estimate->estimate_number }}</strong></td>
                            </tr>
                            <tr>
                                <td>Issue Date</td>
                                <td align="right">{{ $estimate->issue_date }}</td>
                            </tr>
                            <tr>
                                <td>Expiry Date</td>
                                <td align="right">{{ $estimate->expiry_date ?? '-' }}</td>
                            </tr>
                        </table>

                        <div style="border-top:1px solid #e5e7eb; margin-top:8px; padding-top:8px; text-align:right;">
                            <small style="text-transform:uppercase;">
                                Grand Total
                            </small><br>
                            <strong style="font-size:18px; color:#6d28d9;">
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
        <table>
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
                        <strong>{{ $item->title }}</strong><br>
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

                    <td class="text-right">
                        <strong style="color:#6d28d9;">
                            ₹ {{ number_format($item->amount,2) }}
                        </strong>
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
                    <td align="right">₹ {{ number_format($estimate->subtotal,2) }}</td>
                </tr>
                <tr>
                    <td>Tax ({{ $estimate->tax_percentage }}%)</td>
                    <td align="right">₹ {{ number_format($estimate->tax_amount,2) }}</td>
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
        <strong style="text-transform:uppercase; color:#6b7280;">
            Notes
        </strong><br><br>
        {{ $estimate->notes }}
    </div>
    @endif

</div>
</div>

</body>
</html>
