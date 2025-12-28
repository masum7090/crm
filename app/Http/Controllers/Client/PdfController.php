<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PdfController extends Controller
{
    public function downloadInvoice($id)
    {
        $invoice = Invoice::whereHas('order', function ($query) {
                // Ensure the user owns the order, unless it's an admin (though this controller is for clients/generic use)
                // For safety, we check ownership if not admin.
                if (!auth()->user()->hasRole('admin')) { // Assuming Spatie roles or similar, or just check ID
                    $query->where('user_id', Auth::id());
                }
            })
            ->with(['order.items.product', 'order.user.info'])
            ->findOrFail($id);

        $pdf = Pdf::loadView('market_place.invoices.pdf', compact('invoice'));

        return $pdf->download('invoice-' . $invoice->invoice_number . '.pdf');
    }
}
