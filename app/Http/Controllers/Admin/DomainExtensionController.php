<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DomainExtension;
use App\Models\Provider;


class DomainExtensionController extends Controller
{
    /**

     * Show all domain extensions.
     */
    public function index(Request $request)
    {
        $query = DomainExtension::with('provider');

        if ($request->filled('extension')) {
            $query->where('extension', 'like', '%' . $request->extension . '%');
        }

        if ($request->filled('provider_id')) {
            $query->where('provider_id', $request->provider_id);
        }

        if ($request->filled('register_price')) {
            $query->where('registration_price', $request->register_price);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active' ? 1 : 0);
        }

        $extensions = $query->orderBy('extension', 'ASC')->paginate(20);
        $providers = Provider::all();

        return view('admin.domain_extensions.index', compact('extensions', 'providers'));
    }




    /**
     * Delete domain extension.
     */
    public function destroy($id)
    {
        DomainExtension::findOrFail($id)->delete();

        return redirect()
            ->route('admin.domain-extensions.index')
            ->with('success', 'Domain extension deleted successfully!');
    }

    public function fetchFromProvider(\App\Services\ResellBizService $resellBizService)
    {
        // Use the new GetDomainPriceList API command
        $priceListData = $resellBizService->getDomainPriceList();
        
        // Debugging: If it's a string, it might be an error or raw XML
        if (is_string($priceListData)) {
            return "API RAW Response: " . htmlspecialchars($priceListData);
        }

        $tlds = [];
        // Support both numeric array and single product object
        $products = $priceListData['product'] ?? [];
        if (isset($products['tld'])) { $products = [$products]; } // Handle single item

        if (!empty($products) && is_array($products)) {
            foreach ($products as $product) {
                // Check if it's a domain product
                if (isset($product['tld']) || (is_array($product) && isset($product['@attributes']['tld']))) {
                    $extension = $product['tld'] ?? $product['@attributes']['tld'];
                    
                    $tlds[] = [
                        'extension' => ltrim($extension, '.'),
                        'register_price' => $product['registration'] ?? $product['addnewdomain'] ?? 0,
                        'renewal_price' => $product['renewal'] ?? $product['renewdomain'] ?? 0,
                        'transfer_price' => $product['transfer'] ?? $product['transferdomain'] ?? 0,
                    ];
                }
            }
        }

        // Fallback: If the above specific structure doesn't match, maybe it's the old structure
        if (empty($tlds)) {
            $pricingData = $resellBizService->getResellerPricing();
            $domPricing = $pricingData['domorder'] ?? [];

            foreach ($domPricing as $tld => $pricing) {
                $tlds[] = [
                    'extension' => ltrim($tld, '.'),
                    'register_price' => $pricing['addnewdomain'][1] ?? 0,
                    'renewal_price' => $pricing['renewdomain'][1] ?? 0,
                    'transfer_price' => $pricing['transferdomain'][1] ?? 0,
                ];
            }
        }

        if (empty($tlds)) {
             return redirect()->route('admin.domain-extensions.index')->with('error', 'No TLDs found or API connection failed. Please verify your credentials and IP whitelisting in your Resell.biz dashboard.');
        }

        return view('admin.domain_extensions.fetch', compact('tlds'));
    }

    /**
     * Store fetched TLDs.
     */
    public function storeFetched(Request $request)
    {
        $allTlds = $request->input('tlds', []);
        $provider = \App\Models\Provider::where('slug', 'resellbiz')->first();

        $count = 0;
        foreach ($allTlds as $tldData) {
            if (isset($tldData['selected']) && $tldData['selected'] == '1') {
                DomainExtension::updateOrCreate(
                    ['extension' => $tldData['extension']],
                    [
                        'provider_id' => $provider->id ?? null,
                        'registration_price' => $tldData['register_price'],
                        'renewal_price' => $tldData['renewal_price'],
                        'transfer_price' => $tldData['transfer_price'],
                        'is_active' => true
                    ]
                );
                $count++;
            }
        }

        return redirect()->route('admin.domain-extensions.index')->with('success', "$count TLDs synchronized successfully!");
    }
}
