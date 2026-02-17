<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Estimate {{ $estimate->estimate_number }}</title>

<style>
    body{
        font-family: DejaVu Sans, sans-serif;
        background:#111827;
        margin:0;
        font-size:12px;
        color:#e5e7eb;
    }

    .wrapper{
        padding:25px;
    }

    .card{
        background:#1f2937;
        border:1px solid #374151;
        border-radius:10px;
        overflow:hidden;
    }

    .header{
        padding:20px;
        border-bottom:1px solid #374151;
    }

    .left{
        float:left;
        width:60%;
    }

    .right{
        float:right;
        width:40%;
        text-align:right;
        font-size:11px;
        line-height:16px;
        color:#9ca3af;
    }

    .clear{ clear:both; }

    .section{
        padding:20px;
        border-bottom:1px solid #374151;
    }

    .grid-left{
        float:left;
        width:55%;
    }

    .grid-right{
        float:right;
        width:40%;
    }

    .info-box{
        background:#111827;
        border:1px solid #374151;
        padding:12px;
        font-size:11px;
    }

    table{
        width:100%;
        border-collapse:collapse;
        font-size:11px;
    }

    table th{
        background:#111827;
        color:#d1d5db;
        border:1px solid #374151;
        padding:6px;
        text-align:left;
    }

    table td{
        border:1px solid #374151;
        padding:6px;
    }

    .text-right{ text-align:right; }

    .summary{
        width:260px;
        float:right;
        background:#111827;
        border:1px solid #374151;
        padding:12px;
        font-size:11px;
    }

    .row{
        margin-bottom:6px;
        display:flex;
        justify-content:space-between;
    }

    .total{
        border-top:1px solid #374151;
        padding-top:8px;
        font-weight:bold;
        font-size:13px;
        color:#818cf8;
    }

    .notes{
        padding:20px;
    }
</style>
</head>

<body>

<div class="wrapper">
<div class="card">

    {{-- HEADER --}}
    <div class="header">

        <div class="left">
            @if($setting->company_logo)
                <img src="{{ public_path('storage/'.$setting->company_logo) }}"
                     style="height:45px; background:white; padding:4px; border-radius:6px;"><br>
            @endif

            <strong style="font-size:14px; color:#ffffff;">
                {{ $setting->company_name }}
            </strong><br>
            <span style="color:#9ca3af;">
                Estimate Document
            </span>
        </div>

        <div class="right">
            <strong style="color:#ffffff;">
                {{ $setting->company_name }}
            </strong><br>
            {{ $setting->company_address }}<br>
            {{ $setting->company_email }}<br>
            {{ $setting->company_phone }}
        </div>

        <div class="clear"></div>
    </div>


    {{-- CLIENT + ESTIMATE --}}
    <div class="section">

        <div class="grid-left">
            <strong style="text-transform:uppercase; font-size:11px; color:#9ca3af;">
                Bill To
            </strong><br><br>

            <strong style="color:#ffffff;">
                {{ $estimate->client->name }}
            </strong><br>
            {{ $estimate->client->address }}<br>
            {{ $estimate->client->email }}<br>
            {{ $estimate->client->phone }}
        </div>

        <div class="grid-right">
            <div class="info-box">

                <div style="display:flex; justify-content:space-between;">
                    <span style="color:#9ca3af;">Estimate #</span>
                    <span style="color:#ffffff;">
                        {{ $estimate->estimate_number }}
                    </span>
                </div>

                <div style="display:flex; justify-content:space-between;">
                    <span style="color:#9ca3af;">Issue Date</span>
                    <span>{{ $estimate->issue_date }}</span>
                </div>

                <div style="display:flex; justify-content:space-between;">
                    <span style="color:#9ca3af;">Expiry Date</span>
                    <span>{{ $estimate->expiry_date ?? '-' }}</span>
                </div>

                <div style="border-top:1px solid #374151; margin-top:8px; padding-top:8px; text-align:right;">
                    <small style="color:#9ca3af;">Grand Total</small><br>
                    <strong style="font-size:14px; color:#818cf8;">
                        ₹ {{ number_format($estimate->total,2) }}
                    </strong>
                </div>

            </div>
        </div>

        <div class="clear"></div>
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
                        <strong style="color:#ffffff;">
                            {{ $item->title }}
                        </strong><br>
                        <small style="color:#9ca3af;">
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
                        <strong style="color:#818cf8;">
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

            <div class="row">
                <span style="color:#9ca3af;">Subtotal</span>
                <span>₹ {{ number_format($estimate->subtotal,2) }}</span>
            </div>

            <div class="row">
                <span style="color:#9ca3af;">
                    Tax ({{ $estimate->tax_percentage }}%)
                </span>
                <span>₹ {{ number_format($estimate->tax_amount,2) }}</span>
            </div>

            <div class="row total">
                <span>Total</span>
                <span>₹ {{ number_format($estimate->total,2) }}</span>
            </div>

        </div>

        <div class="clear"></div>
    </div>


    {{-- NOTES --}}
    @if($estimate->notes)
    <div class="notes">
        <strong style="color:#9ca3af;">Notes:</strong><br>
        {{ $estimate->notes }}
    </div>
    @endif

</div>
</div>

</body>
</html>
