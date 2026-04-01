<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::whereHas('order', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->latest()
            ->paginate(10);
            
        return view('market_place.invoices.index', compact('invoices'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $invoice = Invoice::whereHas('order', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->with('order.items.product', 'order.user.info')
            ->findOrFail($id);
            
        return view('market_place.invoices.show', compact('invoice'));
    }
}
