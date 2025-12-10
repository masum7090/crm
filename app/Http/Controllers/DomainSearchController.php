<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;



class DomainSearchController extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'domain' => 'required|string'
        ]);

        $domain = $request->domain;
        $parts = explode('.', $domain);

        $name = $parts[0];
        $tld = $parts[1] ?? 'com';

        $url = "https://domaincheck.httpapi.com/api/domains/available.json";

        $response = Http::get($url, [
            'auth-userid'  => 1068521,
            'api-key'      => "O8JDF1upFptN16E3HouukhmPzSCrq7YH",
            'domain-name'  => $name,
            'tlds'         => $tld,
        ]);

        return response()->json($response->json());
    }
}
