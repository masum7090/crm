<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ResellBizService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class DomainController extends Controller
{
    protected $domainService;

    public function __construct(ResellBizService $domainService)
    {
        $this->domainService = $domainService;
    }

    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        $perPage = 10;

        $params = [
            'no-of-records' => $perPage,
            'page-no' => $page,
            'order-by' => 'creationtime', // descending by default if supported, or just creationtime
        ];

        try {
            // Call the ResellBiz API
            $response = $this->domainService->searchOrders($params);
            
            // Debug the response structure if needed, but assuming standard format
            // API typically returns keys: 'recsonpage', 'recsindb', 'data' => [...]
            
            $domains = $response ?? []; // Fallback
            
            // We need to fit this into Laravel Paginator for the view
            // If the API returns 'recsindb' (total records), we can build a proper paginator
            $total = $response['recsindb'] ?? 0;
            $items = [];
            
            // The API usually returns numeric keys for items inside the response array, or a 'data' key?
            // The provided docs don't specify the EXACT response structure for search.json, 
            // but standard LogicBoxes/ResellBiz response for search is typically: 
            // { "1": { ... }, "2": { ... }, "recsonpage": "10", "recsindb": "100" } (associative array where keys are order IDs)
            // We need to iterate and filter out the metadata keys.
            
            foreach ($domains as $key => $value) {
                if (is_numeric($key) && is_array($value)) {
                    $items[] = $value;
                }
            }
            
            $paginator = new LengthAwarePaginator(
                $items,
                $total,
                $perPage,
                $page,
                ['path' => $request->url(), 'query' => $request->query()]
            );

            return view('admin.domains.index', compact('paginator'));

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to fetch domains: ' . $e->getMessage());
        }
    }
}
