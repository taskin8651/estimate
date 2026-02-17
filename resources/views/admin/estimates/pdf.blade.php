<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
body {
    font-family: DejaVu Sans, sans-serif;
    font-size: 12px;
}
table {
    width: 100%;
    border-collapse: collapse;
}
th, td {
    border: 1px solid #ccc;
    padding: 6px;
}
th {
    background: #f3f4f6;
}
</style>
</head>
<body>

<h2>{{ $setting->company_name }}</h2>
<p>
{{ $setting->company_address }}<br>
{{ $setting->company_email }} | {{ $setting->company_phone }}
</p>

<hr>

<h3>Estimate #{{ $estimate->estimate_number }}</h3>
<p>Issue Date: {{ $estimate->issue_date }}</p>

<br>

<table>
<thead>
<tr>
    <th>Services</th>
    <th>Qty</th>
    <th>Rate</th>
    <th>Amount</th>
</tr>
</thead>

<tbody>
@foreach($estimate->items as $item)
<tr>
    <td>{{ $item->title }}</td>
    <td>{{ $item->quantity }}</td>
    <td>₹ {{ number_format($item->rate,2) }}</td>
    <td>₹ {{ number_format($item->amount,2) }}</td>
</tr>
@endforeach
</tbody>
</table>

<br>

<p><strong>Total: ₹ {{ number_format($estimate->total,2) }}</strong></p>

</body>
</html>
