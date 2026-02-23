<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@lang("Payment with Stripe")</title>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        .loader {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        .spinner {
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin-bottom: 20px;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="loader">
        <div class="spinner"></div>
        <p>@lang("Redirecting to Stripe...")</p>
    </div>

    <script>
        "use strict";
        var stripe = Stripe('{{ $data->publishable_key }}');

        // Immediately redirect to Stripe
        stripe.redirectToCheckout({
            sessionId: '{{ $data->checkoutSession->id }}'
        }).then(function(result) {
            if (result.error) {
                window.location.href = "{{ route('failed') }}";
            }
        });
    </script>
</body>
</html>
