<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Active Life',
            'Arts & Entertainment',
            'Automotive',
            'Beauty & Spas',
            'Education',
            'Event Planning & Services',
            'Financial Services',
            'Food',
            'Health & Medical',
            'Home Services',
            'Hotels & Travel',
            'Local Flavor',
            'Local Services',
            'Mass Media',
            'Nightlife',
            'Pets',
            'Professional Services',
            'Public Services & Government',
            'Real Estate',
            'Religious Organizations',
            'Restaurants',
            'Shopping',
        ];

        foreach ($names as $key => $name)
            DB::table('business_types')->insert([
                'name' =>  $name,
                'picture' =>  "user_assets/img/business_type/" . ($key + 1) . ".png",
                'created_at' => now(),
                'updated_at' => now()
            ]);
    }
}
