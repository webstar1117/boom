<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'firstname' => 'daniel',
            'lastname' => 'bachev',
            'email' => 'qwe@qwe.com',
            'password' => Hash::make('qweqwe'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}