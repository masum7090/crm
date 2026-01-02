<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $domainCat = Category::where('slug', 'domain')->first();
        $hostingCat = Category::where('slug', 'hosting')->first();
        $vpsCat = Category::where('slug', 'vps')->first();
        $dedicatedCat = Category::where('slug', 'dedicated-server')->first();

        // Domain Product
        if ($domainCat) {
            Product::create([
                'name' => 'Domain Registration',
                'slug' => 'domain-registration',
                'description' => 'Register your unique domain name today.',
                'price' => 12.99,
                'category_id' => $domainCat->id,
                'is_active' => true,
            ]);
        }

        // Hosting Products
        if ($hostingCat) {
            $hostings = [
                [
                    'name' => 'Starter Hosting',
                    'slug' => 'starter-hosting',
                    'short_description' => 'Perfect for small websites',
                    'price' => 2.99,
                    'monthly_price' => 3.99,
                    'category_id' => $hostingCat->id,
                ],
                [
                    'name' => 'Business Hosting',
                    'slug' => 'business-hosting',
                    'short_description' => 'Optimized for high performance',
                    'price' => 9.99,
                    'monthly_price' => 12.99,
                    'category_id' => $hostingCat->id,
                ],
            ];
            foreach ($hostings as $h) {
                Product::create($h);
            }
        }

        // VPS Products
        if ($vpsCat) {
            $vps = [
                [
                    'name' => 'VPS Core',
                    'slug' => 'vps-core',
                    'short_description' => '2 vCPU, 4GB RAM, 80GB SSD',
                    'price' => 19.99,
                    'monthly_price' => 24.99,
                    'category_id' => $vpsCat->id,
                ],
                [
                    'name' => 'VPS Elite',
                    'slug' => 'vps-elite',
                    'short_description' => '4 vCPU, 8GB RAM, 160GB SSD',
                    'price' => 39.99,
                    'monthly_price' => 49.99,
                    'category_id' => $vpsCat->id,
                ],
            ];
            foreach ($vps as $v) {
                Product::create($v);
            }
        }
    }
}
