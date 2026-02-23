<?php

namespace App\Services\Gateway\stripe;

use App\Models\Fund;
use Facades\App\Services\BasicService;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;

class Payment
{
    public static function prepareData($order, $gateway)
    {
        $basic = (object) config('basic');
        Stripe::setApiKey($gateway->parameters->secret_key);
        Stripe::setApiVersion('2023-08-16');

        try {
            $checkoutSession = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => strtolower($order->gateway_currency),
                        'product_data' => [
                            'name' => optional($order->user)->username ?? $basic->site_title,
                            'description' => 'Payment with Stripe',
                        ],
                        'unit_amount' => round($order->final_amount, 2) * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'metadata' => [
                    'trx' => $order->transaction,
                    'user_id' => optional($order->user)->id,
                ],
                'cancel_url' => route('failed'),
                'success_url' => route('ipn', [
                    'code' => 'stripe',
                    'trx' => $order->transaction,
                    'type' => 'success'
                ]).'?session_id={CHECKOUT_SESSION_ID}',
            ]);

            $order->btc_wallet = $checkoutSession->id;
            $order->save();

            $send =  [
                'view' => 'user.payment.stripe',
                'checkoutSession' => $checkoutSession,
                'publishable_key' => $gateway->parameters->publishable_key,
            ];
            return json_encode($send);

        } catch (ApiErrorException $e) {
            $send = [
                'error' => true,
                'message' => $e->getMessage()
            ];
            return json_encode($send);

        }
    }

    public static function ipn($request, $gateway, $order = null, $trx = null, $type = null)
    {
        // Handle success redirect (no webhook)
        if ($type === 'success') {
            Stripe::setApiKey($gateway->parameters->secret_key);

            try {
                $sessionId = $request->get('session_id');
                $session = Session::retrieve($sessionId);
                // Verify the session matches our order
                if ($session->payment_status === 'paid' &&
                    $session->metadata->trx === $trx) {

                    if ($order && $order->status == 0) {
                        BasicService::preparePaymentUpgradation($order);
                        return [
                            'status' => 'success',
                            'msg' => 'Payment successful',
                            'redirect' => route('home')
                        ];
                    }
                }
            } catch (\Exception $e) {
                \Log::error("Stripe IPN Error: ".$e->getMessage());
            }

            return [
                'status' => 'error',
                'msg' => 'Payment verification failed',
                'redirect' => route('home')
            ];
        }

        // Fallback for webhook if you enable it later
        return ['status' => 'pending'];
    }
}
