<!DOCTYPE html>
<html lang="si">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>දාන වාරය සිහිකැඳවීම</title>
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
            color: #333;
            line-height: 2;
            margin-bottom: 14px;
        }

        .schedule-box {
            background-color: #fdf6ec;
            border-left: 4px solid #8B4513;
            padding: 16px 20px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .schedule-box p {
            margin: 6px 0;
            font-size: 15px;
            color: #444;
        }

        .warning {
            color: #c0392b;
            font-style: italic;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f5f0e8;
        }

        .footer p {
            font-size: 14px;
            color: #555;
            line-height: 1.8;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>මාතංග ආරණ්‍ය සේනාසනය</h1>
            <p>දාන වාරය සිහිකැඳවීම</p>
        </div>
        <div class="body">
            <p>
                පින්වත් &nbsp; {{ $alms->honorifics }} {{ $alms->first_name }} {{ $alms->last_name }}
                &nbsp; {{ $alms->salutation }},
            </p>

            <p>ඔඛගේ දාන වාරය සම්බන්ධවයි.</p>

            <p>
                ඔබගේ දාන වාරය
                <strong>{{ \Carbon\Carbon::parse($alms->next_reminder_date)->format('Y-m-d') }}</strong>
                දිනට යෙදී ඇත. එම දාන වාරය සඳහා ඔබගේ සහභාගීත්වය ස්ථිර කරගැනීම සඳහා
                WhatsApp අංක <strong>0766101085</strong> නොපමාව අප වෙත දැනුම් දෙන මෙන් සිහිපත් කර සිටිමි.
            </p>

            <p>
                එය ඉතා ම වැදගත්ය. නැතහොත් ඒ දිනට නො පැමිණෙක දාන වාරයක් වශයෙන් සළකනු ලැබේ.
            </p>

            <div class="schedule-box">
                <p>පෙ.ව. 6.00 &nbsp;&mdash;&nbsp; උදෑසන බුද්ධ පූජාව හා හීල් දානය.</p>
                <p>පෙ.ව. 10.00 &nbsp;&mdash;&nbsp; දහවල් බුද්ධ පූජාව හා පුණ්‍යානුමෝදනාව.</p>
                <p>පෙ.ව. 10.45 &nbsp;&mdash;&nbsp; සාංඝික දානය.</p>
            </div>

            <p class="warning">මේ වෙලාවෙන් පසු දානය සේනාසනයට රැගෙන ඒමෙන් වළකින්න.</p>

            <p>තෙරුවණ් සරණයි.</p>
        </div>
        <div class="footer">
            <p>සසුන් ලදී</p>
            <p><strong>ලේකම්</strong><br>මාතංග ආරණ්‍ය සේනාසනය</p>
        </div>
    </div>
</body>

</html>