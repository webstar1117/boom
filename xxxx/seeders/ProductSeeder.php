<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 1; $i < 13; $i++)
            DB::table('products')->insert([
                'id' => $i,
                'business_id' => '1',
                'name' =>  $faker->lexify("??????"),
                'picture' =>  "products/$i.jpg",
                'description' =>   $faker->text(50),
                'category_id' =>  $faker->numberBetween(1, 19),
                'price' =>  $faker->numberBetween(100, 999),
                'quantity' =>  $faker->numberBetween(1, 20),
                'created_at' => now(),
                'updated_at' => now()
            ]);
    }
}
