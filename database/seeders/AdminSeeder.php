<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
           'name' => 'abdullah',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
        ]);

        User::create([
            'name' => 'Osama Arafa',
            'email' => 'admin@admin.com',
            'phone' => '01016830875',
            'password' => bcrypt('123456'),
            'role_id' => 1
        ]);

        User::create([
            'name' => 'Osama Arafa',
            'email' => 'user@admin.com',
            'phone' => '01016830875',
            'password' => bcrypt('123456'),
            'role_id' => 2
        ]);


    }
}
