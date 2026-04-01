<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DomainController extends Controller
{
    /**
     * Handle domain registration from home page "Buy Now"
     */
    public function register(Request $request)
    {
        $request->validate([
            'domain' => 'required|string',
            'price' => 'required'
        ]);

        $product = Product::where('slug', 'domain-registration')->first();
        if (!$product) {
            $product = Product::create([
                'name' => 'Domain Registration',
                'slug' => 'domain-registration',
                'price' => 12.99,
                'category_id' => 1
            ]);
        }

        // Store domain info in session
        Session::put('pending_domain', [
            'name' => $request->domain,
            'price' => (float) str_replace(['$', 'US ', 'US$'], '', $request->price),
            'type' => 'registration'
        ]);

        return redirect()->route('checkout-page', ['product_id' => $product->id]);
    }

    /**
     * Domain transfer view
     */
    public function transferView()
    {
        return view('market_place.domains.transfer');
    }

    /**
     * Process domain transfer request
     */
    public function transferProcess(Request $request)
    {
        $request->validate([
            'domain' => 'required|string',
            'auth_code' => 'required|string'
        ]);

        $product = Product::where('slug', 'domain-registration')->first();
        
        Session::put('pending_domain', [
            'name' => $request->domain,
            'price' => 15.00, // Fixed transfer price
            'type' => 'transfer',
            'auth_code' => $request->auth_code
        ]);

        return redirect()->route('checkout-page', ['product_id' => $product->id]);
    }

    /**
     * Domain renewal view
     */
    public function renewView()
    {
        return view('market_place.domains.renew');
    }

    /**
     * Process domain renewal request
     */
    public function renewProcess(Request $request)
    {
        $request->validate([
            'domain' => 'required|string'
        ]);

        $product = Product::where('slug', 'domain-registration')->first();
        
        Session::put('pending_domain', [
            'name' => $request->domain,
            'price' => 15.00, // Fixed renewal price
            'type' => 'renewal'
        ]);

        return redirect()->route('checkout-page', ['product_id' => $product->id]);
    }
}
