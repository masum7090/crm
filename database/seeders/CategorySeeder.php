<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Domain', 'slug' => 'domain'],
            ['name' => 'Hosting', 'slug' => 'hosting'],
            ['name' => 'VPS', 'slug' => 'vps'],
            ['name' => 'Dedicated Server', 'slug' => 'dedicated-server'],
            ['name' => 'Email Service', 'slug' => 'email-service'],
            ['name' => 'SSL Certificate', 'slug' => 'ssl-certificate'],
            ['name' => 'Hardware', 'slug' => 'hardware'],
            ['name' => 'Software', 'slug' => 'software'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category['name'],
                'slug' => Str::slug($category['slug']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
