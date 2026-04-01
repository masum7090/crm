<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ResellBizService;
use Illuminate\Http\Request;

class DomainOrderController extends Controller
{
    protected $resellBizService;

    public function __construct(ResellBizService $resellBizService)
    {
        $this->resellBizService = $resellBizService;
    }

    public function index(Request $request)
    {
        $perPage = 50;
        $currentPage = $request->get('page', 1);

        $params = [
            'page-no' => $currentPage,
            'no-of-records' => $perPage,
        ];

        if ($request->filled('domain')) {
            $params['domain-name'] = $request->domain;
        }

        $response = $this->resellBizService->searchOrders($params);

        if (isset($response['status']) && $response['status'] === 'ERROR') {
            return view('admin.domain_orders.index', [
                'orders' => collect([]),
                'error' => $response['message'] ?? 'API Error'
            ]);
        }

        $orders = [];
        $total = 0;

        if (is_array($response)) {
            $total = (int)($response['recsindb'] ?? 0);
            foreach ($response as $key => $value) {
                if (is_numeric($key) && is_array($value)) {
                    // Flatten keys like "orders.domainname" -> "domainname"
                    $flattened = [];
                    foreach ($value as $vKey => $vVal) {
                        $newKey = str_contains($vKey, '.') ? explode('.', $vKey)[1] : $vKey;
                        $flattened[$newKey] = $vVal;
                    }
                    $orders[] = $flattened;
                }
            }
        }

        $paginatedOrders = new \Illuminate\Pagination\LengthAwarePaginator(
            $orders,
            $total,
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.domain_orders.index', ['orders' => $paginatedOrders]);
    }
}
