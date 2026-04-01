<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HostingController extends Controller
{
    /**
     * Display a listing of hosting plans.
     */
    public function index()
    {
        // Fetch active hosting plans
        // We can group them by hosting_type (Shared, VPS, etc.) for tabs or sections
        
        $plans = Product::where('is_active', true)
            ->where(function ($q) {
                // Check if it's marked as hosting in meta OR linked to hosting category
                $q->where('meta->is_hosting', true)
                  ->orWhereHas('category', function($cat) {
                      $cat->where('name', 'like', '%Hosting%');
                  });
            })
            ->orderBy('price', 'asc')
            ->get();

        // Group by type for easier display
        $groupedPlans = $plans->groupBy(function ($item) {
            return $item->meta['hosting_type'] ?? 'shared';
        });

        // Fetch active add-ons
        $addons = \App\Models\Addon::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('market_place.hosting.index', compact('groupedPlans', 'addons'));
    }
}
