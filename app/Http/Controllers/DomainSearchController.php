<?php

namespace App\Http\Controllers;

use App\Services\ResellBizService;
use Illuminate\Http\Request;

class DomainSearchController extends Controller
{
    protected $domainService;

    public function __construct(ResellBizService $domainService)
    {
        $this->domainService = $domainService;
    }

    public function check(Request $request)
    {
        $request->validate([
            'domain' => 'required|string|min:3'
        ]);

        try {
            $result = $this->domainService->checkAvailability($request->domain);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Search failed', 'message' => $e->getMessage()], 500);
        }
    }
}
