<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Estimate {{ $estimate->estimate_number }}</title>

<style>
body{
    font-family: DejaVu Sans, sans-serif;
    margin:0;
    background:#fefce8; /* soft yellow */
    font-size:12px;
    color:#374151;
}

.wrapper{
    padding:25px;
}

.card{
    background:#ffffff;
    border:1px solid #facc15;
    border-radius:8px;
    overflow:hidden;
}

/* HEADER */
.header{
    background:#fef9c3; /* light gold */
    padding:25px;
    border-bottom:1px solid #facc15;
}

.header table{
    width:100%;
}

.header td{
    vertical-align:top;
}

.logo{
    height:45px;
}

.company-name{
    font-weight:bold;
    font-size:15px;
    text-transform:uppercase;
    letter-spacing:1px;
}

.premium-text{
    font-size:11px;
    color:#b45309;
    text-transform:uppercase;
    letter-spacing:2px;
}

/* SECTION */
.section{
    padding:25px;
    border-bottom:1px solid #fde68a;
}

.info-box{
    background:#fffbeb;
    border:1px solid #facc15;
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
    background:#fef3c7;
    color:#78350f;
    padding:8px;
    border:1px solid #facc15;
    text-align:left;
    font-weight:bold;
}

table td{
    padding:8px;
    border:1px solid #fde68a;
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
    padding:6px 0;
}

.total{
    border-top:1px solid #facc15;
    padding-top:8px;
    font-weight:bold;
    font-size:16px;
    color:#b45309;
}

.notes{
    padding:25px;
}

.notes-title{
    text-transform:uppercase;
    font-weight:bold;
    font-size:11px;
    letter-spacing:2px;
    color:#b45309;
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

                    <div class="company-name">
                        {{ $setting->company_name }}
                    </div>
                    <div class="premium-text">
                        Premium Estimate
                    </div>
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

                    <div style="text-transform:uppercase;
                                font-weight:bold;
                                font-size:11px;
                                letter-spacing:2px;
                                color:#b45309;">
                        Bill To
                    </div><br>

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
                                <td>Issue Date</td>
                                <td align="right">{{ $estimate->issue_date }}</td>
                            </tr>
                            <tr>
                                <td>Expiry Date</td>
                                <td align="right">{{ $estimate->expiry_date ?? '-' }}</td>
                            </tr>
                        </table>

                        <div style="border-top:1px solid #facc15; margin-top:8px; padding-top:8px; text-align:right;">
                            <small style="text-transform:uppercase; color:#92400e;">
                                Grand Total
                            </small><br>
                            <strong style="font-size:18px; color:#b45309;">
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
                        <strong style="color:#b45309;">
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
