<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([RoleSeeder::class, UsersTableSeeder::class]);
        $this->call([ProductSeeder::class, CategorySeeder::class, TagSeeder::class, ItemSeeder::class]);
        $this->call([
            CustomerSeeder::class,
            BusinessSeeder::class, 
            BusinessTypeSeeder::class, 
            ReviewSeeder::class
        ]);
        $this->call([
            BlogCategorySeeder::class,
            BlogSeeder::class, 
        ]);
    }
}
