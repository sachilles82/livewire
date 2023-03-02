<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory()->count(4)->create();

        $this->call([
            CountriesSeeder::class,
        ]);

        Product::factory(6)->create()->each(function ($product) {
            $product->categories()
                ->saveMany(Category::factory(mt_rand(1, 2))->make());
        });
    }

}
