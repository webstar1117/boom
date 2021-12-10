<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        DB::table('reviews')->insert([
            'business_id' => '1',
            'customer_id' => 1,
            'rating' => 5,
            'content' => $faker->text(1500),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('reviews')->insert([
            'business_id' => '1',
            'customer_id' => 2,
            'rating' => 4.5,
            'content' =>$faker->text(1500),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('reviews')->insert([
            'business_id' => '1',
            'customer_id' => 3,
            'rating' => 3.5,
            'content' => $faker->text(1500),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
