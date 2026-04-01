<?php

namespace Database\Seeders;

use App\Models\Provider;
use Illuminate\Database\Seeder;

class ProviderSeeder extends Seeder
{
    public function run(): void
    {
        $providers = [
            [
                'name' => 'ResellBiz',
                'slug' => 'resellbiz',
                'description' => 'Global domain registrar and hosting provider',
                'is_active' => true,
            ],
            [
                'name' => 'Namecheap',
                'slug' => 'namecheap',
                'description' => 'User-friendly domain and hosting services',
                'is_active' => true,
            ],
            [
                'name' => 'GoDaddy',
                'slug' => 'godaddy',
                'description' => 'World largest domain registrar',
                'is_active' => true,
            ],
        ];

        foreach ($providers as $provider) {
            Provider::create($provider);
        }
    }
}
