<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Estimate {{ $estimate->estimate_number }}</title>
</head>

<body style="margin:0; padding:0; background:#f3f4f6; font-family:Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f3f4f6; padding:40px 0;">
<tr>
<td align="center">

<table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 5px 20px rgba(0,0,0,0.05);">

    {{-- HEADER --}}
    <tr>
        <td style="background:#2563eb; padding:30px; color:white;">
            <h2 style="margin:0;">{{ $setting->company_name }}</h2>
            <p style="margin:5px 0 0; font-size:14px; opacity:0.9;">
                Estimate Document
            </p>
        </td>
    </tr>

    {{-- BODY --}}
    <tr>
        <td style="padding:30px;">

            <p style="font-size:15px; margin:0 0 15px;">
                Hello <strong>{{ $estimate->client->name }}</strong>,
            </p>

            <p style="font-size:14px; color:#555; margin-bottom:25px;">
                Please find attached your estimate details. Below is a quick summary:
            </p>

            {{-- ESTIMATE INFO BOX --}}
            <table width="100%" cellpadding="8" cellspacing="0" style="background:#f9fafb; border-radius:6px; margin-bottom:20px;">
                <tr>
                    <td style="font-size:13px; color:#666;">Estimate Number</td>
                    <td align="right"><strong>{{ $estimate->estimate_number }}</strong></td>
                </tr>
                <tr>
                    <td style="font-size:13px; color:#666;">Issue Date</td>
                    <td align="right">{{ $estimate->issue_date }}</td>
                </tr>
                <tr>
                    <td style="font-size:13px; color:#666;">Total Amount</td>
                    <td align="right" style="font-size:16px; font-weight:bold; color:#111;">
                        ₹ {{ number_format($estimate->total,2) }}
                    </td>
                </tr>
            </table>

            <p style="font-size:14px; color:#555;">
                The detailed estimate is attached as a PDF for your reference.
            </p>

            <p style="margin-top:25px; font-size:14px;">
                If you have any questions, feel free to reply to this email.
            </p>

            <p style="margin-top:20px; font-size:14px;">
                Regards,<br>
                <strong>{{ $setting->company_name }}</strong><br>
                <span style="color:#666; font-size:13px;">
                    {{ $setting->company_email }}<br>
                    {{ $setting->company_phone }}
                </span>
            </p>

        </td>
    </tr>

    {{-- FOOTER --}}
    <tr>
        <td style="background:#f9fafb; padding:15px; text-align:center; font-size:12px; color:#888;">
            © {{ date('Y') }} {{ $setting->company_name }}. All rights reserved.
        </td>
    </tr>

</table>

</td>
</tr>
</table>

</body>
</html>
