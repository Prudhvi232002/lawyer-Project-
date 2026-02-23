<!DOCTYPE html>
<html lang="en">
    @php
    $site_title = App\Models\GeneralSetting::where('name', 'site_title')->first();
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
            background-color: #28a745;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Password Reset Successful</h2>
        <p>Dear {{ $user->name }},</p>
        <p>Your password has been reset successfully. If you did not request this change, please contact our support team immediately.</p>
        <a href="{{ url('/login') }}" class="btn">Login to Your Account</a>
        <p>Best Regards,<br><strong>{{ $site_title && $site_title->value ? $site_title->value : config('app.name', 'Admin') }} Team</strong></p>
    </div>
</body>

</html>
