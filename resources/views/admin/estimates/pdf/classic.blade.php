<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Estimate {{ $estimate->estimate_number }}</title>

<style>
body {
    font-family: DejaVu Sans, sans-serif;
    font-size: 12px;
    color: #333;
}

.container {
    width: 100%;
}

.header {
    border-bottom: 1px solid #ddd;
    padding-bottom: 15px;
    margin-bottom: 20px;
}

.logo {
    float: left;
}

.company-info {
    float: left;
    margin-left: 15px;
}

.company-info h2 {
    margin: 0;
    font-size: 18px;
}

.company-info p {
    margin: 2px 0;
    font-size: 11px;
    color: #666;
}

.company-right {
    float: right;
    text-align: right;
    font-size: 11px;
    color: #666;
}

.clear {
    clear: both;
}

.section {
    margin-bottom: 20px;
}

.box {
    border: 1px solid #ddd;
    padding: 10px;
    background: #f9f9f9;
    width: 250px;
    float: right;
    font-size: 11px;
}

.box div {
    margin-bottom: 5px;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table th {
    background: #7e22ce;
    color: #fff;
    padding: 8px;
    font-size: 12px;
    text-align: left;
}

.table td {
    padding: 8px;
    border-bottom: 1px solid #eee;
    font-size: 11px;
}

.text-right {
    text-align: right;
}

.summary {
    width: 250px;
    float: right;
    margin-top: 20px;
}

.summary table {
    width: 100%;
}

.summary td {
    padding: 5px 0;
    font-size: 11px;
}

.total-row {
    border-top: 1px solid #000;
    font-weight: bold;
    font-size: 13px;
}

.notes {
    margin-top: 30px;
    padding: 10px;
    border: 1px solid #ddd;
    background: #f9f9f9;
    font-size: 11px;
}
</style>
</head>

<body>

<div class="container">

    {{-- ================= HEADER ================= --}}
    <div class="header">

        <div class="logo">
            @if($setting->company_logo)
                <img src="{{ public_path('storage/'.$setting->company_logo) }}"
                     height="50">
            @endif
        </div>

        <div class="company-info">
            <h2>{{ $setting->company_name }}</h2>
            <p>Estimate Document</p>
        </div>

        <div class="company-right">
            {{ $setting->company_address }}<br>
            {{ $setting->company_email }}<br>
            {{ $setting->company_phone }}
        </div>

        <div class="clear"></div>
    </div>


    {{-- ================= CLIENT + ESTIMATE BOX ================= --}}
    <div class="section">

        <div style="float:left; width:60%;">
            <strong>Bill To:</strong><br>
            {{ $estimate->client->name }}<br>
            {{ $estimate->client->address }}<br>
            {{ $estimate->client->email }}<br>
            {{ $estimate->client->phone }}
        </div>

        <div class="box">
            <div>
                <strong>Estimate #:</strong>
                <span style="float:right;">{{ $estimate->estimate_number }}</span>
            </div>
            <div>
                <strong>Issue Date:</strong>
                <span style="float:right;">{{ $estimate->issue_date }}</span>
            </div>
            <div>
                <strong>Expiry:</strong>
                <span style="float:right;">{{ $estimate->expiry_date ?? '-' }}</span>
            </div>
            <hr>
            <div style="text-align:right;">
                <small>Grand Total</small><br>
                <strong style="font-size:14px;">
                    ₹ {{ number_format($estimate->total,2) }}
                </strong>
            </div>
        </div>

        <div class="clear"></div>
    </div>


    {{-- ================= ITEMS TABLE ================= --}}
    <table class="table">
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
                    <span style="font-size:10px; color:#777;">
                        {{ $item->description }}
                    </span>
                </td>
                <td class="text-right">
                    {{ $item->quantity }}
                </td>
                <td class="text-right">
                    ₹ {{ number_format($item->rate,2) }}
                </td>
                <td class="text-right">
                    ₹ {{ number_format($item->amount,2) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


    {{-- ================= SUMMARY ================= --}}
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

            <tr class="total-row">
                <td>Total</td>
                <td class="text-right">
                    ₹ {{ number_format($estimate->total,2) }}
                </td>
            </tr>
        </table>
    </div>

    <div class="clear"></div>


    {{-- ================= NOTES ================= --}}
    @if($estimate->notes)
    <div class="notes">
        <strong>Notes:</strong><br>
        {{ $estimate->notes }}
    </div>
    @endif

</div>

</body>
</html>
