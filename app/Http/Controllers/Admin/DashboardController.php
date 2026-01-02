<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $total_clients = \App\Models\User::count();
        $total_orders = \App\Models\Order::count();
        $pending_orders = \App\Models\Order::where('status', 'pending')->count();
        $total_revenue = \App\Models\Invoice::where('status', 'paid')->sum('total_amount');

        $recent_users = \App\Models\User::latest()->take(5)->get();
        $recent_orders = \App\Models\Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'total_clients',
            'total_orders',
            'pending_orders',
            'total_revenue',
            'recent_users',
            'recent_orders'
        ));
    }
}
