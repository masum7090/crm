<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Fetch summary stats
        $totalOrders = $user->orders()->count();
        $unpaidInvoices = $user->invoices()->where('invoices.status', 'unpaid')->count();
        
        // Fetch purchased items from completed orders
        $purchasedItems = \App\Models\OrderItem::whereHas('order', function($query) use ($user) {
            $query->where('user_id', $user->id)
                  ->where('status', 'completed');
        })->with('product')->latest()->get();

        return view('market_place.dashboard', compact('totalOrders', 'unpaidInvoices', 'purchasedItems'));
    }
}
