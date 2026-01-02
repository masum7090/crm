<?php

namespace Database\Seeders;

use App\Models\DomainExtension;
use App\Models\Provider;
use Illuminate\Database\Seeder;

class DomainExtensionSeeder extends Seeder
{
    public function run(): void
    {
        $resellbiz = Provider::where('slug', 'resellbiz')->first();
        if (!$resellbiz) return;

        $extensions = [
            [
                'extension' => 'com',
                'provider_id' => $resellbiz->id,
                'registration_price' => 12.99,
                'renewal_price' => 14.99,
                'transfer_price' => 12.99,
                'is_active' => true,
            ],
            [
                'extension' => 'net',
                'provider_id' => $resellbiz->id,
                'registration_price' => 14.99,
                'renewal_price' => 16.99,
                'transfer_price' => 14.99,
                'is_active' => true,
            ],
            [
                'extension' => 'org',
                'provider_id' => $resellbiz->id,
                'registration_price' => 13.99,
                'renewal_price' => 15.99,
                'transfer_price' => 13.99,
                'is_active' => true,
            ],
            [
                'extension' => 'info',
                'provider_id' => $resellbiz->id,
                'registration_price' => 10.99,
                'renewal_price' => 12.99,
                'transfer_price' => 10.99,
                'is_active' => true,
            ],
            [
                'extension' => 'biz',
                'provider_id' => $resellbiz->id,
                'registration_price' => 11.99,
                'renewal_price' => 13.99,
                'transfer_price' => 11.99,
                'is_active' => true,
            ],
        ];

        foreach ($extensions as $extension) {
            DomainExtension::create($extension);
        }
    }
}
