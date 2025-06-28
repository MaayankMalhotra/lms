<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Webinar Confirmation</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, sans-serif; background: linear-gradient(to right, #2c0b57, #0c3c7c); color: #ffffff;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.3); overflow: hidden;">
        <tr>
            <td style="padding: 20px; text-align: center; background-color: #ffffff;">
                <img src="http://16.16.64.105/images/THINK%20CHAMP%20logo2.png" alt="Think Champ Logo" style="width: 180px; height: auto; margin-bottom: 10px;">
            </td>
        </tr>
        <tr>
            <td style="padding: 30px 20px 10px; text-align: center;">
                <h1 style="margin: 0; font-size: 28px; font-weight: bold; background: linear-gradient(to right, #fbbf24, #f97316); -webkit-background-clip: text; color: transparent;">
                    Webinar Confirmation
                </h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <p style="font-size: 16px; color: #333;">
                    Dear <strong>{{ $enrollment['name'] }}</strong>,
                </p>
                
                <ul style="font-size: 16px; color: #333; padding-left: 20px;">
                    <li><strong>Attendance Verification Code:</strong> {{ $data['attendance_code'] }}</li>
                    <li><strong>Meeting ID:</strong> {{ $data['meeting_id'] }}</li>
                    <li><strong>Meeting Link:</strong> <a href="{{ $data['meeting_link'] }}" style="color: #0c3c7c; text-decoration: underline;">Join Meeting</a></li>
                    <li><strong>Meeting Password:</strong> {{ $data['meeting_password'] }}</li>
                </ul>
                <p style="font-size: 16px; color: #333;">
                    We look forward to seeing you!
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
