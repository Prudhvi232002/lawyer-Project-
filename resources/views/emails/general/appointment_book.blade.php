<!DOCTYPE html>
@php
    $site_title = App\Models\GeneralSetting::where('name', 'site_title')->first();
@endphp
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Registration</title>
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
        <h2>New Appointment Registered Successfully</h2>
        <p>Dear {{ $email_user->name ?? '' }},</p>
        <p>Your appointment has been booked successfully. Here are the details:</p>
        <p><strong>Appointment ID:</strong> {{ $appointment->id }}</p>
        <p><strong>Customer Name:</strong> {{ $appointment->customer ? $appointment->customer->name : 'No Name' }}</p>
        <p><strong>Lawyer Name:</strong> {{ $appointment->lawyer ? $appointment->lawyer->name : 'No Name' }}</p>
        <p><strong>Law Firm:</strong> {{ $appointment->law_firm_id ? $appointment->law_firm->name : 'No Firm Selected' }}</p>
        <p><strong>Date:</strong> {{ $appointment->date }}</p>
        <p><strong>Start Time:</strong> {{ $appointment->start_time }}</p>
        <p><strong>End Time:</strong> {{ $appointment->end_time }}</p>
        <p><strong>Fee:</strong> {{ $appointment->fee }}</p>
        <p><strong>Payment Status:</strong> {{ $appointment->is_paid ? 'Paid' : 'Unpaid' }}</p>
        <p><strong>Appointment Type:</strong> {{ $appointment->appointment_type ? $appointment->appointment_type->display_name : 'Default' }}</p>
        <p><strong>Question:</strong> {{ $appointment->question }}</p>
        <p><strong>Status:</strong>
            @php
                $statusDescription = '';
                switch ($appointment->appointment_status_code) {
                    case 1:
                        $statusDescription = 'Appointment is Registered';
                        break;
                    case 2:
                        $statusDescription = 'Appointment Accepted Successfully';
                        break;
                    case 3:
                        $statusDescription = 'Appointment Rejected Successfully';
                        break;
                    case 4:
                        $statusDescription = 'Appointment Cancelled Successfully';
                        break;
                    case 5:
                        $statusDescription = 'Appointment Marked as Completed Successfully';
                        break;
                    default:
                        $statusDescription = 'Unknown Status';
                }
            @endphp
            {{ $statusDescription }}
        </p>
        <p>If you have any questions, feel free to contact our support team.</p>
        <p>Best Regards,<br><strong>{{ $site_title && $site_title->value ? $site_title->value : config('app.name', 'Admin') }} Team</strong></p>
    </div>
</body>

</html>
