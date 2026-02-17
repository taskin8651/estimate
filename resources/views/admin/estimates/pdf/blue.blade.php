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
    border: 1px solid #e5e7eb;
}

/* ================= HEADER ================= */

.header {
    background: #2563eb;
    color: white;
    padding: 15px 20px;
}

.header-left {
    float: left;
}

.header-left img {
    vertical-align: middle;
}

.header-left .company {
    display: inline-block;
    margin-left: 10px;
    vertical-align: middle;
}

.header-left h2 {
    margin: 0;
    font-size: 14px;
}

.header-left p {
    margin: 2px 0 0;
    font-size: 10px;
    opacity: 0.8;
}

.header-right {
    float: right;
    text-align: right;
    font-size: 10px;
}

.clear {
    clear: both;
}

/* ================= SECTION ================= */

.section {
    padding: 15px 20px;
    border-bottom: 1px solid #e5e7eb;
}

.bill-to {
    float: left;
    width: 55%;
}

.bill-to h4 {
    margin: 0 0 5px;
    font-size: 10px;
    text-transform: uppercase;
    color: #2563eb;
}

.info-box {
    float: right;
    width: 200px;
    border: 1px solid #bfdbfe;
    background: #eff6ff;
    padding: 10px;
    font-size: 10px;
}

.info-box div {
    margin-bottom: 4px;
}

.info-box hr {
    border: none;
    border-top: 1px solid #bfdbfe;
    margin: 6px 0;
}

/* ================= TABLE ================= */

.table-section {
    padding: 15px 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    background: #2563eb;
    color: white;
}

th, td {
    border: 1px solid #e5e7eb;
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

/* ================= SUMMARY ================= */

.summary {
    width: 200px;
    float: right;
    margin-top: 15px;
    font-size: 10px;
}

.summary div {
    margin-bottom: 5px;
}

.summary .total {
    border-top: 1px solid #e5e7eb;
    padding-top: 6px;
    font-weight: bold;
    font-size: 12px;
    color: #1d4ed8;
}

/* ================= NOTES ================= */

.notes {
    padding: 15px 20px;
    border-top: 1px solid #e5e7eb;
}

.notes-box {
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    padding: 10px;
    font-size: 10px;
}
</style>
</head>

<body>

<div class="wrapper">

    {{-- ================= HEADER ================= --}}
    <div class="header">

        <div class="header-left">
            @if($setting->company_logo)
                <img src="{{ public_path('storage/'.$setting->company_logo) }}"
                     height="35">
            @endif

            <div class="company">
                <h2>{{ $setting->company_name }}</h2>
                <p>Estimate Document</p>
            </div>
        </div>

        <div class="header-right">
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
                Issue:
                <span style="float:right;">
                    {{ $estimate->issue_date }}
                </span>
            </div>

            <div>
                Expiry:
                <span style="float:right;">
                    {{ $estimate->expiry_date ?? '-' }}
                </span>
            </div>

            <hr>

            <div style="text-align:right;">
                <small style="color:#2563eb;">Grand Total</small><br>
                <strong style="color:#1d4ed8;">
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
                    <td class="text-right" style="color:#2563eb;">
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
        <div class="notes-box">
            <strong style="color:#2563eb;">Notes</strong><br>
            {{ $estimate->notes }}
        </div>
    </div>
    @endif

</div>

</body>
</html>
