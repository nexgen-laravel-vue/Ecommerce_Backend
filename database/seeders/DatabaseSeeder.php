<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductDetails;
use App\Models\role;
use App\Models\userrolemapping;
use App\Models\AddressType;
use App\Models\CustomerAdd;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

            Category::factory()->create();
            Brand::factory()->create();
            ProductDetails::factory()->create();
            role::factory()->create();
            userrolemapping::factory()->create();
            AddressType::factory()->create();
            CustomerAdd::factory()->create();
    }
}
