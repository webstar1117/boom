<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'id' => 1,
            'first_name' => 'Jake',
            'last_name' => 'Wilkinson',
            'email' => 'jake@gmail.com',
            'phoneNo' => '(+1) 206-578-1121',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('customers')->insert([
            'id' => 2,
            'first_name' => 'Tegan',
            'last_name' => 'Holmes',
            'email' => 'tegan@gmail.com',
            'phoneNo' => '(+1) 406-731-6451',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('customers')->insert([
            'id' => 3,
            'first_name' => 'Tyler',
            'last_name' => 'Gray',
            'email' => 'tyler@gmail.com',
            'phoneNo' => '(+1) 218-777-6360',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
