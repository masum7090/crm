<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ResellBizService
{
    protected $userId;
    protected $apiKey;
    protected $checkUrl = 'https://domaincheck.httpapi.com/api/domains/available.json';
    protected $searchUrl = 'https://test.httpapi.com/api/domains/search.json'; // User provided test URL for search

    public function __construct()
    {
        // Ideally these should come from config('services.resellbiz')
        $this->userId = 1068521;
        $this->apiKey = "O8JDF1upFptN16E3HouukhmPzSCrq7YH";
    }

    /**
     * Check domain availability
     */
    public function checkAvailability($domain)
    {
        $parts = explode('.', $domain);
        $name = $parts[0];
        
        // Default TLDs to check
        $tldsToCheck = ['com', 'net', 'org', 'biz', 'info'];
        if (isset($parts[1]) && !in_array($parts[1], $tldsToCheck)) {
             array_unshift($tldsToCheck, $parts[1]);
        }
        
        // Manual query string construction for repeated 'tlds' parameter
        $queryString = http_build_query([
            'auth-userid' => $this->userId,
            'api-key' => $this->apiKey,
            'domain-name' => $name,
        ]);

        foreach ($tldsToCheck as $tld) {
            $queryString .= '&tlds=' . $tld;
        }

        $finalUrl = $this->checkUrl . '?' . $queryString;
        
        $response = Http::get($finalUrl);
        
        return $this->formatAvailabilityResponse($response->json());
    }

    /**
     * Search existing domain orders
     */
    public function searchOrders(array $params = [])
    {
        $defaults = [
            'auth-userid' => $this->userId,
            'api-key' => $this->apiKey,
            'no-of-records' => 10,
            'page-no' => 1,
        ];

        $queryParams = array_merge($defaults, $params);
        
        $response = Http::get($this->searchUrl, $queryParams);
        
        return $response->json();
    }

    /**
     * Format availability API response for frontend
     */
    protected function formatAvailabilityResponse($data)
    {
        $results = [];
        
        if (is_array($data)) {
            foreach ($data as $domainStr => $info) {
                $status = is_array($info) ? ($info['status'] ?? 'unknown') : $info;
                $isAvailable = strtolower($status) === 'available';
                
                $tld = pathinfo($domainStr, PATHINFO_EXTENSION);
                $priceMap = [
                    'com' => '$12.99',
                    'net' => '$14.99',
                    'org' => '$11.99',
                    'biz' => '$9.99',
                    'info'=> '$4.99'
                ];
                $price = $priceMap[$tld] ?? '$15.00';

                $results[] = [
                    'domain' => $domainStr,
                    'available' => $isAvailable,
                    'status' => $status,
                    'price' => $isAvailable ? $price : 'N/A',
                ];
            }
        }
        
        return ['domains' => $results];
    }
}
