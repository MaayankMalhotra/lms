<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Your Webinar Certificate</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, sans-serif; background: linear-gradient(to right, #2c0b57, #0c3c7c); color: #ffffff;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.3); overflow: hidden;">
        <tr>
            <td style="padding: 20px; text-align: center;">
                <img src="http://16.16.64.105/images/THINK%20CHAMP%20logo2.png" alt="Think Champ Logo" style="width: 180px; height: auto; margin-bottom: 10px;">
            </td>
        </tr>
        <tr>
            <td style="padding: 30px 20px 10px; text-align: center;">
                <h1 style="margin: 0; font-size: 26px; font-weight: bold; background: linear-gradient(to right, #fbbf24, #f97316); -webkit-background-clip: text; color: transparent;">
                    Certificate of Participation
                </h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <p style="font-size: 16px; color: #333;">
                    Hello <strong>{{ $enrollment->name }}</strong>,
                </p>

                <p style="font-size: 16px; color: #333;">
                    Thank you for attending the webinar: <strong>{{ $enrollment->webinar->title ?? 'Webinar' }}</strong>.
                </p>

                <p style="font-size: 16px; color: #333;">
                    We are pleased to send you your certificate of participation.
                </p>

                <p style="font-size: 16px; color: #333;">
                    Please view your certificate using the button below:
                </p>

                <p style="text-align: center; margin: 20px 0;">
                    <a href="{{ $certificateUrl }}" target="_blank" 
                       style="display: inline-block; padding: 12px 24px; background-color: #0c3c7c; color: #ffffff; text-decoration: none; border-radius: 5px; font-size: 16px; font-weight: bold;">
                        View Certificate
                    </a>
                </p>

                <p style="font-size: 16px; color: #333;">
                    We hope you enjoyed the session and look forward to your participation in future events!
                </p>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px; text-align: center; background: #2c0b57; color: #fff;">
                <p style="margin: 0; font-size: 14px;">© {{ date('Y') }} Think Champ. All rights reserved.</p>
            </td>
        </tr>
    </table>
</body>
</html>

