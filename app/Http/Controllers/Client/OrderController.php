<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(\Illuminate\Http\Request $request)
    {
        $query = Order::with('invoice')
            ->where('user_id', Auth::id());

        // Search by Order ID
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('id', 'like', "%{$search}%");
        }

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by Date Range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Filter by Amount Range
        if ($request->filled('min_amount')) {
            $query->where('total_amount', '>=', $request->min_amount);
        }
        if ($request->filled('max_amount')) {
            $query->where('total_amount', '<=', $request->max_amount);
        }

        $perPage = $request->input('per_page', 10);
        $orders = $query->latest()->paginate($perPage)->withQueryString();
            
        return view('market_place.orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::with('items.product', 'invoice')
            ->where('user_id', Auth::id())
            ->findOrFail($id);
            
        return view('market_place.orders.show', compact('order'));
    }
}
