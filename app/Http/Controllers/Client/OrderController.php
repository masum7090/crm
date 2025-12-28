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
    public function index()
    {
        $orders = Order::with('invoice')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);
            
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
