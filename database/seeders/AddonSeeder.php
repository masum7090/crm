<?php

namespace Database\Seeders;

use App\Models\Addon;
use Illuminate\Database\Seeder;

class AddonSeeder extends Seeder
{
    public function run(): void
    {
        $addons = [
            [
                'name' => 'SSL Certificate',
                'slug' => 'ssl-certificate',
                'description' => 'Secure your website with HTTPS encryption',
                'icon' => '🔒',
                'price' => 49.99,
                'billing_cycle' => 'yearly',
                'type' => 'ssl',
                'is_popular' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Domain Privacy Protection',
                'slug' => 'domain-privacy',
                'description' => 'Hide your personal information from WHOIS lookup',
                'icon' => '🛡️',
                'price' => 9.99,
                'billing_cycle' => 'yearly',
                'type' => 'domain_privacy',
                'is_popular' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Daily Backups',
                'slug' => 'daily-backups',
                'description' => 'Automatic daily backups of your website',
                'icon' => '💾',
                'price' => 24.99,
                'billing_cycle' => 'yearly',
                'type' => 'backup',
                'is_popular' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Professional Email (5 accounts)',
                'slug' => 'professional-email',
                'description' => 'Get professional email addresses with your domain',
                'icon' => '📧',
                'price' => 39.99,
                'billing_cycle' => 'yearly',
                'type' => 'email',
                'is_popular' => false,
                'sort_order' => 4,
            ],
            [
                'name' => 'CDN Service',
                'slug' => 'cdn-service',
                'description' => 'Speed up your website with global CDN',
                'icon' => '🚀',
                'price' => 59.99,
                'billing_cycle' => 'yearly',
                'type' => 'cdn',
                'is_popular' => false,
                'sort_order' => 5,
            ],
            [
                'name' => 'Website Security Suite',
                'slug' => 'security-suite',
                'description' => 'Advanced malware scanning and removal',
                'icon' => '🔐',
                'price' => 79.99,
                'billing_cycle' => 'yearly',
                'type' => 'security',
                'is_popular' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($addons as $addon) {
            Addon::create($addon);
        }
    }
}
