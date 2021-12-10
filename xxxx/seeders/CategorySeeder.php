<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Category::create(['name' => 'Appliances',]);
        Category::create(['name' => 'Apps & Games',]);
        Category::create(['name' => 'Arts, Crafts, & Sewing',]);
        Category::create(['name' => 'Automotive Parts & Accessories',]);
        Category::create(['name' => 'Baby',]);
        Category::create(['name' => 'Beauty & Personal Care',]);
        Category::create(['name' => 'Books',]);
        Category::create(['name' => 'CDs & Vinyl',]);
        Category::create(['name' => 'Cell Phones & Accessories',]);
        Category::create(['name' => 'Clothing, Shoes and Jewelry',]);
        Category::create(['name' => 'Collectibles & Fine Art',]);
        Category::create(['name' => 'Computers',]);
        Category::create(['name' => 'Food',]);
        Category::create(['name' => 'Handmade',]);
        Category::create(['name' => 'Health, Household & Baby Care',]);
        Category::create(['name' => 'Musical Instruments',]);
        Category::create(['name' => 'Office Products',]);
        Category::create(['name' => 'Sports & Outdoors',]);
        Category::create(['name' => 'Toys & Games',]);
    }
}
