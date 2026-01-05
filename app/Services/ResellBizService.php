<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ResellBizService
{
    protected $userId;
    protected $apiKey;
    protected $checkUrl = 'https://domaincheck.httpapi.com/api/domains/available.json';
    protected $searchUrl = 'https://httpapi.com/api/domains/search.json'; // Live URL
    protected $pricingUrl = 'https://httpapi.com/api/products/reseller-cost-price.json'; // Live URL
    protected $tldListXmlUrl = 'https://httpapi.com/api/domains/preordering/fetchtldlist.xml'; // Live URL
    protected $tldInPhaseXmlUrl = 'https://httpapi.com/api/domains/tlds-in-phase.xml'; // Live URL
    protected $xmlApiUrl = 'https://api.resell.biz/xml.response'; // Primary
    protected $xmlApiFallbackUrl = 'https://httpapi.com/api/domains/xml.response'; // Standard LogicBoxes Fallback

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
            'no-of-records' => 50,
            'page-no' => 1,
        ];

        $queryParams = array_merge($defaults, $params);
        
        $response = Http::get($this->searchUrl, $queryParams);
        
        return $response->json();
    }

    /**
     * Purchase (Register) a domain
     */
    public function purchaseDomain($domain, $customer_id, $years = 1)
    {
        // Mocking successful response for now
        // Actual API call: https://test.httpapi.com/api/domains/register.json
        return [
            'status' => 'Success',
            'domain' => $domain,
            'orderid' => rand(100000, 999999),
            'actionid' => rand(100000, 999999),
            'entityid' => rand(100000, 999999),
        ];
    }

    /**
     * Transfer a domain
     */
    public function transferDomain($domain, $auth_code, $customer_id)
    {
        // Mocking successful response
        // Actual API call: https://test.httpapi.com/api/domains/transfer.json
        return [
            'status' => 'Success',
            'domain' => $domain,
            'orderid' => rand(100000, 999999),
        ];
    }

    /**
     * Renew a domain
     */
    public function renewDomain($domain, $years = 1)
    {
        // Mocking successful response
        // Actual API call: https://test.httpapi.com/api/domains/renew.json
        return [
            'status' => 'Success',
            'domain' => $domain,
            'orderid' => rand(100000, 999999),
        ];
    }

    /**
     * Get TLD list from XML API
     */
    public function getTldListFromXml($category = 'services')
    {
        $response = Http::get($this->tldListXmlUrl, [
            'auth-userid' => $this->userId,
            'api-key' => $this->apiKey,
            'category' => $category
        ]);

        if ($response->failed()) {
            \Illuminate\Support\Facades\Log::error('ResellBiz XML TLD List Failure:', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            return [];
        }

        try {
            $xml = simplexml_load_string($response->body());
            $json = json_encode($xml);
            return json_decode($json, true);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('ResellBiz XML Parsing Error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get TLDs in a specific phase (e.g., sunrise, landrush, general_availability)
     */
    public function getTldsInPhase($phase = 'general_availability')
    {
        $response = Http::get($this->tldInPhaseXmlUrl, [
            'auth-userid' => $this->userId,
            'api-key' => $this->apiKey,
            'phase' => $phase
        ]);

        if ($response->failed()) {
            \Illuminate\Support\Facades\Log::error('ResellBiz TLDs In Phase Failure:', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            return [];
        }

        try {
            $xml = simplexml_load_string($response->body());
            $json = json_encode($xml);
            return json_decode($json, true);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('ResellBiz XML Phase Parsing Error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get Domain Price List using the raw XML/POST API
     */
    public function getDomainPriceList()
    {
        try {
            $response = Http::asForm()
                ->timeout(30) // Increased timeout
                ->post($this->xmlApiUrl, [
                    'auth-userid' => $this->userId,
                    'api-key' => $this->apiKey,
                    'command' => 'GetDomainPriceList',
                ]);

            if ($response->failed()) {
                // If primary fails, try fallback
                \Illuminate\Support\Facades\Log::warning('Resell.biz Primary API Failed, trying fallback...');
                $response = Http::asForm()
                    ->timeout(30)
                    ->post($this->xmlApiFallbackUrl, [
                        'auth-userid' => $this->userId,
                        'api-key' => $this->apiKey,
                        'command' => 'GetDomainPriceList',
                    ]);
            }

            if ($response->failed()) {
                \Illuminate\Support\Facades\Log::error('ResellBiz GetDomainPriceList Failure (Both Primary & Fallback):', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return $response->body(); // Return raw body for debugging
            }

            $body = $response->body();
            // If the body is clearly NOT XML (e.g. contains "error"), return as string
            if (stripos($body, '<?xml') === false && stripos($body, '<response') === false) {
                 return $body;
            }

            $xml = simplexml_load_string($body);
            if ($xml === false) {
                return $body;
            }
            $json = json_encode($xml);
            return json_decode($json, true);

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('ResellBiz API Connection/Parsing Error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get reseller pricing for all TLDs
     */
    public function getResellerPricing()
    {
        $response = Http::get($this->pricingUrl, [
            'auth-userid' => $this->userId,
            'api-key' => $this->apiKey,
        ]);

        if ($response->failed()) {
            \Illuminate\Support\Facades\Log::error('ResellBiz API Failure:', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
        }

        return $response->json() ?: $response->body();
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
                
                // Fetch pricing from Database instead of Static Map
                $extension = \App\Models\DomainExtension::where('extension', $tld)->first();
                $price = $extension ? '$' . number_format($extension->registration_price, 2) : 'N/A';

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
