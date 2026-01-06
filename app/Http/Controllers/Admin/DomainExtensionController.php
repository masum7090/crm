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
        $tlds = [];
        $page = 1;
        $perPage = 50; 
        $maxPages = 20; // Safety limit to avoid infinite loops
        
        try {
            do {
                $pricingData = $resellBizService->getResellerPricing($page, $perPage);
                
                // If it's a string, it might be an error or raw XML
                if (is_string($pricingData)) {
                    if ($page === 1) {
                        return "API ERROR/RAW Response: " . htmlspecialchars($pricingData);
                    }
                    break; 
                }

                $domPricing = $pricingData['domorder'] ?? [];
                if (empty($domPricing)) {
                    break;
                }

                foreach ($domPricing as $tld => $pricing) {
                    $tlds[] = [
                        'extension' => ltrim($tld, '.'),
                        'register_price' => $pricing['addnewdomain'][1] ?? 0,
                        'renewal_price' => $pricing['renewdomain'][1] ?? 0,
                        'transfer_price' => $pricing['transferdomain'][1] ?? 0,
                    ];
                }
                
                // If the number of TLDs returned is less than perPage, we've reached the end
                if (count($domPricing) < $perPage) {
                    break;
                }
                
                $page++;
            } while ($page <= $maxPages);

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('TLD Fetch Error: ' . $e->getMessage());
            if (empty($tlds)) {
                return redirect()->route('admin.domain-extensions.index')->with('error', 'Exception during TLD fetch: ' . $e->getMessage());
            }
        }

        if (empty($tlds)) {
             return redirect()->route('admin.domain-extensions.index')->with('error', 'No TLDs found or API connection failed. Please verify your credentials and IP whitelisting in your Resell.biz dashboard.');
        }

        // Unique by extension to be safe
        $tlds = collect($tlds)->unique('extension')->values()->all();

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
