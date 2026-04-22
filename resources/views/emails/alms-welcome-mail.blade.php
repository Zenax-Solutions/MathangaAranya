<!DOCTYPE html>
<html lang="si">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Alms Registration - Mathanga Aranya Senasanaya</title>
    <style>
        body,
        p {
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #f5f0e8;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
        }

        .header {
            text-align: center;
            padding: 30px 20px 20px;
            background-color: #8B4513;
        }

        .header h1 {
            font-size: 22px;
            color: #ffffff;
            margin: 0;
        }

        .header p {
            font-size: 14px;
            color: #f5deb3;
            margin-top: 6px;
        }

        .body {
            padding: 30px 20px;
        }

        .body p {
            font-size: 16px;
            color: #444;
            line-height: 1.8;
            margin-bottom: 14px;
        }

        .detail-box {
            background-color: #fdf6ec;
            border-left: 4px solid #8B4513;
            padding: 16px 20px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .detail-box p {
            margin: 6px 0;
            font-size: 15px;
            color: #555;
        }

        .detail-box strong {
            color: #333;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f5f0e8;
        }

        .footer p {
            font-size: 13px;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Mathanga Aranya Senasanaya</h1>
            <p>Daily Alms Registration Confirmation</p>
        </div>
        <div class="body">
            <p>Dear {{ $alms->honorifics }} {{ $alms->first_name }} {{ $alms->last_name }},</p>
            <p>
                Thank you for registering for the Daily Alms (දාන වාරය) at Mathanga Aranya Senasanaya.
                Your registration has been received successfully.
            </p>

            <div class="detail-box">
                <p><strong>Name:</strong> {{ $alms->honorifics }} {{ $alms->first_name }} {{ $alms->last_name }}</p>
                <p><strong>Dana Date:</strong> {{ \Carbon\Carbon::parse($alms->next_reminder_date)->format('F j, Y') }}</p>
                <p><strong>Frequency:</strong> {{ ucfirst($alms->type) }}</p>
                <p><strong>Meal:</strong>
                    @if($alms->meal_type === 'breakfast')
                    Breakfast Dana &mdash; 6:00 AM (උදෑසන හීල් දානය)
                    @else
                    Lunch Dana &mdash; 10:00 AM (දහවල් සාංඝික දානය)
                    @endif
                </p>
                <p><strong>Email:</strong> {{ $alms->email }}</p>
                <p><strong>WhatsApp:</strong> {{ $alms->whatsapp_number }}</p>
            </div>

            <p>
                You will receive a reminder email 3 days before your dana date.
                Please confirm your attendance by contacting us on WhatsApp: <strong>0766101085</strong>.
            </p>

            <p>
                Daily Schedule at the Senasanaya:<br>
                &bull; 6:00 AM &mdash; Morning Buddha Puja &amp; Breakfast Dana (හීල් දානය)<br>
                &bull; 10:00 AM &mdash; Midday Buddha Puja &amp; Punyanumodanawa<br>
                &bull; 10:45 AM &mdash; Sanghika Dana (සාංඝික දානය)
            </p>

            <p><em>Please do not bring dana after these times.</em></p>

            <p>May the Triple Gem bless you.<br><strong>තෙරුවණ් සරණයි.</strong></p>
        </div>
        <div class="footer">
            <p>සසුන් ලදී</p>
            <p><strong>ලේකම්, මාතංග ආරණ්‍ය සේනාසනය</strong></p>
        </div>
    </div>
</body>

</html>