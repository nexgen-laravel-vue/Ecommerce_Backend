<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductDetails;
use App\Models\role;
use App\Models\userrolemapping;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

            Category::factory()->create();
            Brand::factory()->create();
            ProductDetails::factory()->create();
            role::factory()->create();
            userrolemapping::factory()->create();
    }
}
