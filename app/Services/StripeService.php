<?php

namespace App\Services;

use App\Models\Invoice;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripeService
{
    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function createCheckoutSession(Invoice $invoice)
    {
        $lineItems = [];

        foreach ($invoice->order->items as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => strtolower($invoice->order->currency),
                    'product_data' => [
                        'name' => $item->description,
                    ],
                    'unit_amount' => (int) ($item->unit_price * 100), // Stripe uses cents
                ],
                'quantity' => $item->quantity,
            ];
        }

        return Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('client.payment.success') . '?session_id={CHECKOUT_SESSION_ID}&invoice_id=' . $invoice->id,
            'cancel_url' => route('client.payment.cancel'),
            'metadata' => [
                'invoice_id' => $invoice->id,
                'order_id' => $invoice->order_id,
            ],
        ]);
    }
}
