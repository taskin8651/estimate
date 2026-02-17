<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Estimate {{ $estimate->estimate_number }}</title>

<style>
    body{
        font-family: DejaVu Sans, sans-serif;
        font-size:12px;
        background:#f3f4f6;
        margin:0;
    }

    .wrapper{
        padding:25px;
    }

    .card{
        background:#ffffff;
        border:1px solid #d1d5db;
        border-radius:6px;
        overflow:hidden;
    }

    .header{
        padding:20px;
        border-bottom:1px solid #d1d5db;
    }

    .header-left{
        float:left;
        width:60%;
    }

    .header-right{
        float:right;
        width:40%;
        text-align:right;
        font-size:11px;
        line-height:16px;
    }

    .clear{
        clear:both;
    }

    .section{
        padding:20px;
        border-bottom:1px solid #d1d5db;
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
        border:1px solid #d1d5db;
        background:#f9fafb;
        padding:12px;
        font-size:11px;
    }

    table{
        width:100%;
        border-collapse:collapse;
        font-size:11px;
    }

    table th{
        background:#f3f4f6;
        border:1px solid #d1d5db;
        padding:6px;
        text-align:left;
        font-weight:bold;
    }

    table td{
        border:1px solid #d1d5db;
        padding:6px;
    }

    .text-right{
        text-align:right;
    }

    .summary{
        width:260px;
        float:right;
        border:1px solid #d1d5db;
        background:#f9fafb;
        padding:12px;
        font-size:11px;
    }

    .summary-row{
        margin-bottom:6px;
        display:flex;
        justify-content:space-between;
    }

    .total{
        border-top:1px solid #d1d5db;
        padding-top:8px;
        font-weight:bold;
        font-size:13px;
    }

    .notes{
        padding:20px;
    }
</style>
</head>

<body>

<div class="wrapper">
<div class="card">

    {{-- ================= HEADER ================= --}}
    <div class="header">

        <div class="header-left">
            @if($setting->company_logo)
                <img src="{{ public_path('storage/'.$setting->company_logo) }}"
                     style="height:50px;"><br>
            @endif

            
        </div>

        <div class="header-right">
            <strong>{{ $setting->company_name }}</strong><br>
            {{ $setting->company_address }}<br>
            {{ $setting->company_email }}<br>
            {{ $setting->company_phone }}
        </div>

        <div class="clear"></div>
    </div>


    {{-- ================= CLIENT + ESTIMATE ================= --}}
    <div class="section">

        <div class="grid-left">
            <strong style="font-size:11px; text-transform:uppercase; color:#666;">
                Bill To
            </strong><br><br>

            <strong>{{ $estimate->client->name }}</strong><br>
            {{ $estimate->client->address }}<br>
            {{ $estimate->client->email }}<br>
            {{ $estimate->client->phone }}
        </div>

        <div class="grid-right">
            <div class="info-box">

                <div style="display:flex; justify-content:space-between;">
                    <span>Estimate #</span>
                    <span><strong>{{ $estimate->estimate_number }}</strong></span>
                </div>

                <div style="display:flex; justify-content:space-between;">
                    <span>Issue Date</span>
                    <span>{{ $estimate->issue_date }}</span>
                </div>

                <div style="display:flex; justify-content:space-between;">
                    <span>Expiry Date</span>
                    <span>{{ $estimate->expiry_date ?? '-' }}</span>
                </div>

                <div style="border-top:1px solid #d1d5db; margin-top:8px; padding-top:8px; text-align:right;">
                    <small>Grand Total</small><br>
                    <strong style="font-size:14px;">
                        ₹ {{ number_format($estimate->total,2) }}
                    </strong>
                </div>

            </div>
        </div>

        <div class="clear"></div>
    </div>


    {{-- ================= TABLE ================= --}}
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
                        <small style="color:#666;">
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
                        <strong>
                            ₹ {{ number_format($item->amount,2) }}
                        </strong>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>


    {{-- ================= SUMMARY ================= --}}
    <div class="section" style="border-bottom:none;">

        <div class="summary">

            <div class="summary-row">
                <span>Subtotal</span>
                <span>₹ {{ number_format($estimate->subtotal,2) }}</span>
            </div>

            <div class="summary-row">
                <span>Vat ({{ $estimate->tax_percentage }}%)</span>
                <span>₹ {{ number_format($estimate->tax_amount,2) }}</span>
            </div>

            <div class="summary-row total">
                <span>Total</span>
                <span>₹ {{ number_format($estimate->total,2) }}</span>
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
</div>

</body>
</html>
