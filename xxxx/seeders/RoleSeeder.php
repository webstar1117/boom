<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'Admin',
            'description' => 'Admin user has full access',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'Business',
            'description' => 'Business user can manage buisness',
            'created_at' => now(),
            'updated_at' => now()
        ]);


        DB::table('roles')->insert([
            'id' => 3,
            'name' => 'User',
            'description' => 'Normal user can use user side',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
