<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserInfo;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $country = Country::first();
        $countryId = $country ? $country->id : null;

        $clients = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Michael Chen',
                'email' => 'michael@example.com',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($clients as $clientData) {
            $user = User::create($clientData);
            
            UserInfo::create([
                'user_id' => $user->id,
                'phone' => '+1234567890',
                'company_name' => $user->name . ' Inc.',
                'address1' => '123 Main St',
                'city' => 'New York',
                'state_region' => 'NY',
                'postcode' => '10001',
                'country_id' => $countryId,
                'is_new_user' => false,
            ]);
        }
    }
}
