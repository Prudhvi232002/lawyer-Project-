<!DOCTYPE html>
@php
    $site_title = App\Models\GeneralSetting::where('name', 'site_title')->first();
@endphp
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome to Lawyer Consultation Portal</title>
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
                background-color: #007bff;
                color: #ffffff;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 5px;
                display: inline-block;
                margin-top: 20px;
            }
            .btn:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
<body>
    <div class="container">
        <h2>Welcome to {{ $site_title && $site_title->value ? $site_title->value : config('app.name', 'Admin') }}!</h2>
        <p>Dear
            @if(isset($customer))
            {{ $customer->first_name }} {{$customer->last_name}},
            @elseif(isset($lawyer))
            {{ $lawyer->first_name }} {{$lawyer->last_name}},
            @elseif(isset($law_firm))
            {{ $law_firm->first_name }} {{$law_firm->last_name}},
            @else
            User,
            @endif
        </p>
        <p>Thank you for signing up for our {{ $site_title && $site_title->value ? $site_title->value : config('app.name', 'Admin') }}. We are thrilled to have you on board!</p>
        <p>With our platform, you can easily connect with experienced legal professionals and get the guidance you need.</p>
        <p>Click the button below to get started:</p>
        <a href="{{ url('/login') }}" class="btn">Get Started</a>
        <p>If you have any questions, feel free to reach out to our support team.</p>
        <p>Best Regards,<br><strong>{{ $site_title && $site_title->value ? $site_title->value : config('app.name', 'Admin') }} Team</strong></p>
    </div>
</body>
</html>
