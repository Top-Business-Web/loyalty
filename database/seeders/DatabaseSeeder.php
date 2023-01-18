<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(SettingSeeder::class);
        $faker = Factory::create();
        for ($i = 0; $i < 5; $i++)
        {
            $category = Category::create([
                'user_id' => 1,
                'name_ar' => $faker->userName,
                'name_en' => $faker->userName,
            ]);
        }
        for ($i = 0; $i < 20; $i++)
        {
            $product = Product::create([
                'name_ar' => $faker->userName,
                'name_en' => $faker->firstName,
                'user_id' => 1,
                'category_id' => rand(1, 5),
                'price' => rand(20, 200),
            ]);
        }
    }
}
