<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Estimate</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .header { display:flex; justify-content:space-between; }
        .box { border:1px solid #ddd; padding:10px; }
        table { width:100%; border-collapse:collapse; margin-top:20px; }
        th, td { border:1px solid #ddd; padding:8px; font-size:12px; }
        th { background:#f5f5f5; }
        .right { text-align:right; }
        .total-box { margin-top:20px; width:40%; float:right; }
    </style>
</head>
<body>

    <div class="header">
        <div>
            <h2>Your Company Name</h2>
            <p>Address line here</p>
            <p>Email | Phone</p>
        </div>

        <div class="box">
            <strong>Estimate #:</strong> {{ $estimate->estimate_number }}<br>
            <strong>Date:</strong> {{ $estimate->issue_date }}<br>
            <strong>Expiry:</strong> {{ $estimate->expiry_date ?? '-' }}
        </div>
    </div>

    <h4>Bill To:</h4>
    <p>
        {{ $estimate->client->name }}<br>
        {{ $estimate->client->email }}<br>
        {{ $estimate->client->phone }}<br>
        {{ $estimate->client->address }}
    </p>

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Qty</th>
                <th>Rate</th>
                <th class="right">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estimate->items as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->rate,2) }}</td>
                <td class="right">{{ number_format($item->amount,2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-box">
        <table>
            <tr>
                <td>Subtotal</td>
                <td class="right">{{ number_format($estimate->subtotal,2) }}</td>
            </tr>
            <tr>
                <td>Tax ({{ $estimate->tax_percentage }}%)</td>
                <td class="right">{{ number_format($estimate->tax_amount,2) }}</td>
            </tr>
            <tr>
                <th>Total</th>
                <th class="right">{{ number_format($estimate->total,2) }}</th>
            </tr>
        </table>
    </div>

    <div style="clear:both;"></div>

    @if($estimate->notes)
        <div style="margin-top:40px;">
            <strong>Notes:</strong>
            <p>{{ $estimate->notes }}</p>
        </div>
    @endif

</body>
</html>
