<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogCategory;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlogCategory::create(['name' => 'News',]);
        BlogCategory::create(['name' => 'Businesses',]);
        BlogCategory::create(['name' => 'Community',]);
        BlogCategory::create(['name' => 'Life-at-Logoslocal',]);
    }
}
