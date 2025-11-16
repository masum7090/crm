<?php

namespace Database\Seeders;

use App\Helpers\CountryData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countryData = CountryData::getList();
        $countries = [];

        foreach ($countryData as $item) {
            $iconPath = 'flag/' . strtolower($item['shortcut']) . '.png';

            // Add each country to the $countries array
            $countries[] = [
                'name' => $item['country_name'],
                'shortcut' => strtolower($item['shortcut']),
                'icon' => $iconPath,
                'phone_number_code' => $item['country_code'],
                'currency' => $item['currency'],
                'currency_rate' => $item['currency_rate'],
                'status' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::table('countries')->insert($countries);
    }
}
