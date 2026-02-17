<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Estimate {{ $estimate->estimate_number }}</title>

<style>
body {
    font-family: DejaVu Sans, sans-serif;
    font-size: 11px;
    color: #333;
}

.wrapper {
    width: 100%;
    border: 1px solid #d1d5db;
}

.header {
    padding: 15px 20px;
    border-bottom: 1px solid #d1d5db;
}

.logo {
    float: left;
}

.company-left {
    float: left;
    margin-left: 10px;
}

.company-left h2 {
    margin: 0;
    font-size: 14px;
}

.company-left p {
    margin: 2px 0;
    font-size: 10px;
    color: #777;
}

.company-right {
    float: right;
    text-align: right;
    font-size: 10px;
    color: #666;
}

.clear {
    clear: both;
}

.section {
    padding: 15px 20px;
    border-bottom: 1px solid #d1d5db;
}

.bill-to {
    float: left;
    width: 55%;
}

.bill-to h4 {
    margin: 0 0 5px;
    font-size: 10px;
    text-transform: uppercase;
    color: #777;
}

.info-box {
    float: right;
    width: 200px;
    border: 1px solid #d1d5db;
    background: #f9fafb;
    padding: 10px;
    font-size: 10px;
}

.info-box div {
    margin-bottom: 4px;
}

.info-box hr {
    margin: 6px 0;
}

.table-section {
    padding: 15px 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    background: #f3f4f6;
}

th, td {
    border: 1px solid #d1d5db;
    padding: 6px;
    font-size: 10px;
}

th {
    font-weight: 600;
    text-align: left;
}

.text-right {
    text-align: right;
}

.summary {
    width: 200px;
    float: right;
    border: 1px solid #d1d5db;
    background: #f9fafb;
    padding: 10px;
    margin-top: 15px;
}

.summary div {
    margin-bottom: 5px;
}

.summary .total {
    border-top: 1px solid #d1d5db;
    padding-top: 6px;
    font-weight: bold;
    font-size: 12px;
}

.notes {
    padding: 15px 20px;
    border-top: 1px solid #d1d5db;
    font-size: 10px;
}
</style>
</head>

<body>

<div class="wrapper">

    {{-- ================= HEADER ================= --}}
    <div class="header">

        <div class="logo">
            @if($setting->company_logo)
                <img src="{{ public_path('storage/'.$setting->company_logo) }}"
                     height="40">
            @endif
        </div>

        <div class="company-left">
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


    {{-- ================= CLIENT + ESTIMATE ================= --}}
    <div class="section">

        <div class="bill-to">
            <h4>Bill To</h4>
            <strong>{{ $estimate->client->name }}</strong><br>
            {{ $estimate->client->address }}<br>
            {{ $estimate->client->email }}<br>
            {{ $estimate->client->phone }}
        </div>

        <div class="info-box">
            <div>
                Estimate #:
                <span style="float:right;">
                    {{ $estimate->estimate_number }}
                </span>
            </div>
            <div>
                Issue Date:
                <span style="float:right;">
                    {{ $estimate->issue_date }}
                </span>
            </div>
            <div>
                Expiry Date:
                <span style="float:right;">
                    {{ $estimate->expiry_date ?? '-' }}
                </span>
            </div>
            <hr>
            <div style="text-align:right;">
                <small>Grand Total</small><br>
                <strong>
                    ₹ {{ number_format($estimate->total,2) }}
                </strong>
            </div>
        </div>

        <div class="clear"></div>
    </div>


    {{-- ================= TABLE ================= --}}
    <div class="table-section">

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
                        <span style="font-size:9px; color:#777;">
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
            <div>
                Subtotal
                <span style="float:right;">
                    ₹ {{ number_format($estimate->subtotal,2) }}
                </span>
            </div>

            <div>
                Vat ({{ $estimate->tax_percentage }}%)
                <span style="float:right;">
                    ₹ {{ number_format($estimate->tax_amount,2) }}
                </span>
            </div>

            <div class="total">
                Total
                <span style="float:right;">
                    ₹ {{ number_format($estimate->total,2) }}
                </span>
            </div>
        </div>

        <div class="clear"></div>

    </div>


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
