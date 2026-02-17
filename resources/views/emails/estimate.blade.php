<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Estimate {{ $estimate->estimate_number }}</title>
</head>

<body style="margin:0; padding:0; background:#f3f4f6; font-family:Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f3f4f6; padding:30px 0;">
<tr>
<td align="center">

<table width="650" cellpadding="0" cellspacing="0"
       style="background:#ffffff; border:1px solid #d1d5db; border-radius:6px; overflow:hidden;">

    {{-- ================= HEADER ================= --}}
    <tr>
        <td style="padding:20px 25px; border-bottom:1px solid #d1d5db;">

            <h2 style="margin:0; font-size:16px; font-weight:bold;">
                {{ $setting->company_name }}
            </h2>

            <p style="margin:5px 0 0; font-size:12px; color:#6b7280;">
                {{ $setting->company_address }}<br>
                {{ $setting->company_email }} | {{ $setting->company_phone }}
            </p>

        </td>
    </tr>


    {{-- ================= CLIENT + INFO ================= --}}
    <tr>
        <td style="padding:20px 25px; border-bottom:1px solid #d1d5db; font-size:12px;">

            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="50%" valign="top">
                        <strong style="font-size:12px; color:#6b7280;">Bill To</strong><br><br>
                        <strong>{{ $estimate->client->name }}</strong><br>
                        {{ $estimate->client->address }}<br>
                        {{ $estimate->client->email }}<br>
                        {{ $estimate->client->phone }}
                    </td>

                    <td width="50%" valign="top" align="right">

                        <table cellpadding="6" cellspacing="0"
                               style="border:1px solid #d1d5db; background:#f9fafb; font-size:12px;">

                            <tr>
                                <td style="color:#6b7280;">Estimate #</td>
                                <td align="right"><strong>{{ $estimate->estimate_number }}</strong></td>
                            </tr>

                            <tr>
                                <td style="color:#6b7280;">Issue Date</td>
                                <td align="right">{{ $estimate->issue_date }}</td>
                            </tr>

                            <tr>
                                <td style="color:#6b7280;">Expiry Date</td>
                                <td align="right">{{ $estimate->expiry_date ?? '-' }}</td>
                            </tr>

                        </table>

                    </td>
                </tr>
            </table>

        </td>
    </tr>


    {{-- ================= ITEMS TABLE ================= --}}
    <tr>
        <td style="padding:20px 25px;">

            <table width="100%" cellpadding="8" cellspacing="0"
                   style="border-collapse:collapse; font-size:12px; border:1px solid #d1d5db;">

                <thead>
                    <tr style="background:#f3f4f6; font-weight:bold;">
                        <th align="left" style="border:1px solid #d1d5db;">Services</th>
                        <th align="right" style="border:1px solid #d1d5db;">Qty</th>
                        <th align="right" style="border:1px solid #d1d5db;">Rate</th>
                        <th align="right" style="border:1px solid #d1d5db;">Amount</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($estimate->items as $item)
                    <tr>
                        <td style="border:1px solid #d1d5db;">
                            <strong>{{ $item->title }}</strong><br>
                            <span style="font-size:11px; color:#6b7280;">
                                {{ $item->description }}
                            </span>
                        </td>
                        <td align="right" style="border:1px solid #d1d5db;">
                            {{ $item->quantity }}
                        </td>
                        <td align="right" style="border:1px solid #d1d5db;">
                            ₹ {{ number_format($item->rate,2) }}
                        </td>
                        <td align="right" style="border:1px solid #d1d5db; font-weight:bold;">
                            ₹ {{ number_format($item->amount,2) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>

        </td>
    </tr>


    {{-- ================= SUMMARY ================= --}}
    <tr>
        <td style="padding:0 25px 20px 25px;">

            <table width="300" align="right" cellpadding="6" cellspacing="0"
                   style="border:1px solid #d1d5db; background:#f9fafb; font-size:12px;">

                <tr>
                    <td>Subtotal</td>
                    <td align="right">₹ {{ number_format($estimate->subtotal,2) }}</td>
                </tr>

                <tr>
                    <td>Vat ({{ $estimate->tax_percentage }}%)</td>
                    <td align="right">₹ {{ number_format($estimate->tax_amount,2) }}</td>
                </tr>

                <tr style="border-top:1px solid #d1d5db; font-weight:bold;">
                    <td>Total</td>
                    <td align="right" style="font-size:14px;">
                        ₹ {{ number_format($estimate->total,2) }}
                    </td>
                </tr>

            </table>

        </td>
    </tr>


    {{-- ================= NOTES ================= --}}
    @if($estimate->notes)
    <tr>
        <td style="padding:20px 25px; border-top:1px solid #d1d5db; font-size:12px;">

            <strong style="color:#6b7280;">Notes</strong><br><br>

            <span style="color:#374151;">
                {{ $estimate->notes }}
            </span>

        </td>
    </tr>
    @endif


    {{-- ================= FOOTER ================= --}}
    <tr>
        <td style="background:#f9fafb; padding:15px; text-align:center;
                   font-size:11px; color:#9ca3af; border-top:1px solid #d1d5db;">

            © {{ date('Y') }} {{ $setting->company_name }}. All rights reserved.

        </td>
    </tr>

</table>

</td>
</tr>
</table>

</body>
</html>
