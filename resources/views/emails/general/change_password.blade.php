<!DOCTYPE html>
<html lang="en">
    @php
    $site_title = App\Models\GeneralSetting::where('name', 'site_title')->first();
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password Request</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .btn {
            background-color: #ffc107;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #e0a800;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Password Change Request</h2>
        <p>Dear {{ $user->name }},</p>
        <p>We received a request to change your password.</p>
        <p>If you did not request a password change, please ignore this email or contact our support team immediately.</p>
        <p>Best Regards,<br><strong>{{ $site_title && $site_title->value ? $site_title->value : config('app.name', 'Admin') }} Team</strong></p>
    </div>
</body>

</html>
