<!DOCTYPE html>
<html>
<body>

<p>Hello {{ $estimate->client->name }},</p>

<p>Please find attached your estimate <strong>{{ $estimate->estimate_number }}</strong>.</p>

<p>Total Amount: <strong>₹ {{ number_format($estimate->total,2) }}</strong></p>

<p>Thank you,<br>
{{ $setting->company_name }}</p>

</body>
</html>
