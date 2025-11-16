<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::insert([
            [
                'name' => 'Super Admin',
                'member_code' => 'ADM001',
                'password' => Hash::make('123456'), // secure hash
                'pincode' => '1234',
                'email' => 'masum@gmail.com',
                'mobile' => '01710000001',
                'balance' => 50000.0,
                'status' => 'active',
                'create_by' => 'system',
                'last_ip' => '127.0.0.1',
                'last_login' => now(),
                'last_login_count' => 5,
                'otp_type' => 'email',
                'is_2fa_enabled' => true,
                'image' => 'superadmin.png',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Support Admin',
                'member_code' => 'ADM002',
                'password' => Hash::make('admin123'),
                'pincode' => '5678',
                'email' => 'admin@gmail.com',
                'mobile' => '01710000002',
                'balance' => 10000.0,
                'status' => 'active',
                'create_by' => 'Super Admin',
                'last_ip' => '127.0.0.1',
                'last_login' => now(),
                'last_login_count' => 3,
                'otp_type' => 'phone',
                'is_2fa_enabled' => false,
                'image' => 'support.png',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
