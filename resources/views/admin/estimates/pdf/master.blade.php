<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Estimate {{ $estimate->estimate_number }}</title>

<style>

body{
font-family: DejaVu Sans, sans-serif;
font-size:14px;
color:#333;
}

.container{
width:100%;
}

.header{
border-bottom:1px solid #ddd;
padding:20px 0;
}

.logo{
float:left;
}

.company-right{
float:right;
text-align:right;
max-width:300px;
font-size:11px;
}

.company-name{
font-size:18px;
font-weight:bold;
margin-bottom:5px;
}

.clear{clear:both}

.section{
padding:20px 0;
border-bottom:1px solid #eee;
}

.bill-to{
float:left;
width:55%;
}

.estimate-box{
float:right;
width:250px;
border:1px solid {{ $theme['box_border'] }};
background: {{ $theme['box_bg'] }};
padding:10px;
}

.table{
width:100%;
border-collapse:collapse;
margin-top:20px;
}

.table th{
background: {{ $theme['table_head'] }};
color:#fff;
padding:8px;
font-size:12px;
text-align:left;
}

.table td{
padding:8px;
border-bottom:1px solid #eee;
}

.text-right{
text-align:right;
}

.summary-section{
margin-top:30px;
}

.notes{
float:left;
width:55%;
}

.summary{
float:right;
width:250px;
background: {{ $theme['box_bg'] }};
border:1px solid {{ $theme['box_border'] }};
padding:10px;
}

.summary table{
width:100%;
}

.total-row{
border-top:1px solid #000;
font-weight:bold;
font-size:13px;
color: {{ $theme['amount'] }};
}

.signature{
margin-top:20px;
text-align:right;
}

.signature img{
height:60px;
}

.footer{
margin-top:40px;
border-top:1px solid #ddd;
padding-top:10px;
text-align:center;
font-size:11px;
color:#666;
}

</style>
</head>

<body>

<div class="container">

{{-- HEADER --}}

<div class="header">

<div class="logo">

@if($setting->company_logo)

@php
$logoPath = public_path('storage/'.$setting->company_logo);
$logoBase64 = null;

if(file_exists($logoPath)){
$type = pathinfo($logoPath, PATHINFO_EXTENSION);
$data = file_get_contents($logoPath);
$logoBase64 = 'data:image/'.$type.';base64,'.base64_encode($data);
}
@endphp

@if($logoBase64)
<img src="{{ $logoBase64 }}" height="50">
@endif

@endif

</div>

<div class="company-right">

<div class="company-name">
{{ $setting->company_name }}
</div>

{{ $setting->company_phone }} |
{{ $setting->company_email }}<br>

@if($setting->company_website)
{{ $setting->company_website }} |
@endif

{{ $setting->company_address }}<br>

@if($setting->trn_number)
TRN: {{ $setting->trn_number }}
@endif

</div>

<div class="clear"></div>

</div>


{{-- CLIENT + ESTIMATE BOX --}}

<div class="section">

<div class="bill-to">

<strong>Bill To:</strong><br>

{{ $estimate->client->name }}<br>
{{ $estimate->client->address }}<br>
{{ $estimate->client->email }}<br>
{{ $estimate->client->phone }}

</div>

<div class="estimate-box">

<div>
<strong>Estimate #</strong>
<span style="float:right">{{ $estimate->estimate_number }}</span>
</div>

<div>
<strong>Issue Date</strong>
<span style="float:right">{{ $estimate->issue_date->format('d M Y') }}</span>
</div>

<div>
<strong>Expiry</strong>
<span style="float:right">
{{ $estimate->expiry_date ? $estimate->expiry_date->format('d M Y') : '-' }}
</span>
</div>

<hr>

<div style="text-align:right">

<small>Grand Total</small><br>

<strong style="font-size:14px;color: {{ $theme['amount'] }}">

{{ $setting->currency }} {{ number_format($estimate->total,2) }}

</strong>

</div>

</div>

<div class="clear"></div>

</div>


{{-- ITEMS TABLE --}}

<table class="table">

<thead>

<tr>
<th>Services</th>
<th>Description</th>
<th class="text-right">Qty</th>
<th class="text-right">Rate</th>
<th class="text-right">Amount</th>
</tr>

</thead>

<tbody>

@foreach($estimate->items as $item)

<tr>

<td>{{ $item->title }}</td>

<td>{{ $item->description }}</td>

<td class="text-right">{{ $item->quantity }}</td>

<td class="text-right">

{{ $setting->currency }} {{ number_format($item->rate,2) }}

</td>

<td class="text-right">

{{ $setting->currency }} {{ number_format($item->amount,2) }}

</td>

</tr>

@endforeach

</tbody>

</table>


{{-- NOTES + SUMMARY --}}

<div class="summary-section">

<div class="notes">

<strong>Notes:</strong><br>

{!! nl2br(e($estimate->notes ?? 'Thank you for your business.')) !!}

@if($setting->payment_terms)

<br><br>

<strong>Payment Terms:</strong><br>

{{ $setting->payment_terms }}

@endif

@if($setting->bank_name)

<br><br>

<strong>Bank Details:</strong><br>

Beneficiary: {{ $setting->bank_beneficiary_name }}<br>
Account No: {{ $setting->bank_account_number }}<br>
Bank Name: {{ $setting->bank_name }}<br>
IBAN: {{ $setting->iban_number }}<br>
SWIFT: {{ $setting->swift_code }}

@endif

</div>

<div class="summary">

<table>

<tr>
<td>Subtotal</td>
<td class="text-right">

{{ $setting->currency }} {{ number_format($estimate->subtotal,2) }}

</td>
</tr>
@foreach($estimate->taxes as $tax)

<tr>
<td>{{ $tax->name }} ({{ $tax->rate }}%)</td>

<td class="text-right">
{{ $setting->currency }} {{ number_format($tax->pivot->amount,2) }}
</td>

</tr>

@endforeach

<tr class="total-row">
<td>Total</td>
<td class="text-right">

{{ $setting->currency }} {{ number_format($estimate->total,2) }}

</td>
</tr>

</table>

</div>

<div class="clear"></div>

</div>


{{-- SIGNATURE --}}

@if($setting->authorized_signature)

@php
$path = public_path('storage/'.$setting->authorized_signature);
$base64=null;

if(file_exists($path)){
$type=pathinfo($path,PATHINFO_EXTENSION);
$data=file_get_contents($path);
$base64='data:image/'.$type.';base64,'.base64_encode($data);
}
@endphp

@if($base64)

<div class="signature">

<img src="{{ $base64 }}"><br>

<strong>Authorized Signatory</strong>

</div>

@endif

@endif


{{-- FOOTER --}}

@if($setting->company_website)

<div class="footer">

{{ $setting->company_website }}

</div>

@endif

</div>

</body>
</html>