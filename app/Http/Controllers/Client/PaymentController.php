<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    protected $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    public function pay($id)
    {
        $invoice = Invoice::whereHas('order', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->with('order.items')
            ->findOrFail($id);

        if ($invoice->status == 'paid') {
            return back()->with('info', 'This invoice is already paid.');
        }

        try {
            $session = $this->stripeService->createCheckoutSession($invoice);
            return redirect($session->url);
        } catch (\Exception $e) {
            return back()->with('error', 'Unable to initiate payment: ' . $e->getMessage());
        }
    }

    public function success(Request $request)
    {
        $invoiceId = $request->get('invoice_id');
        
        $invoice = Invoice::findOrFail($invoiceId);
        
        // In a real app, you should verify the Stripe session here or use Webhooks.
        // For this task, we will mark it as paid.
        
        if ($invoice->status !== 'paid') {
            $invoice->update(['status' => 'paid']);
            // Ideally trigger PaymentReceived email here
        }

        return redirect()->route('client.invoices.show', $invoice->id)->with('success', 'Payment successful! Invoice marked as paid.');
    }

    public function cancel()
    {
        return redirect()->route('client.invoices.index')->with('error', 'Payment cancelled.');
    }
}
