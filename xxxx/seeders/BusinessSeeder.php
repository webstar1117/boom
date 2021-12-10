<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('businesses')->insert([
            'name' => 'Roberto Restaurant',
            'description' => 'The best Italian restaurant in Lagos',
            'business_type_id' => 1,
            'picture' => 'businesses/1.jpg',
            'call' => '+1 234 567 890',
            'website' => 'https://best.restaurant',
            'owner_id' => 2,
            'address' => 'Waec, Jibowu 101245, Lagos, Nigeria',
            'lat' => 6.5179440263097,
            'lng' => 3.3719342651367,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('businesses')->insert([
            'name' => 'Plumber Home service',
            'description' => 'Best plumber service',
            'business_type_id' => 4,
            'picture' => 'businesses/2.jpg',
            'call' => '+1 234 567 890',
            'website' => 'https://best.plumber',
            'owner_id' => 2,
            'address' => '1 Adenubi Cl, Allen 101233, Ikeja, Nigeria',
            'lat' => 6.5976066908153,
            'lng' => 3.3503049316406,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
