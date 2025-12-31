<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::with('order.user')->latest()->paginate(10);
        return view('admin.invoices.index', compact('invoices'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $invoice->load('order.items.product', 'order.user.info');
        return view('admin.invoices.show', compact('invoice'));
    }

    public function updateStatus(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'status' => 'required|in:paid,unpaid,overdue',
        ]);

        $invoice->update(['status' => $validated['status']]);

        return back()->with('success', 'Invoice status updated to ' . ucfirst($validated['status']));
    }
    public function download(Invoice $invoice)
    {
        $invoice->load(['order.items.product', 'order.user.info']);
        $pdf = Pdf::loadView('market_place.invoices.pdf', compact('invoice'));
        return $pdf->download('invoice-' . $invoice->invoice_number . '.pdf');
    }
}
