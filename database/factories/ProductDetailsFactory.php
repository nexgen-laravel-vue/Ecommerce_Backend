<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductDetails>
 */
class ProductDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'brandId'=>15,
            'productName'=>"boat-wireless-5",
            'categoryId'=>29,
            'productDescription'=>'abc',
            'product_img'=>'https://randomwordgenerator.com/img/picture-generator/54e9d1474250ac14f1dc8460962e33791c3ad6e04e5074417d2d73d2904ac4_640.jpg',
            'product_price'=>230,
            'product_stock'=>90
        ];
    }
}
