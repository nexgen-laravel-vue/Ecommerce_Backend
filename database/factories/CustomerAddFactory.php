<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerAdd>
 */
class CustomerAddFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
                'name'=>'Steven Smith',
                'phoneno'=>'8974564455',
                'FlatNumber'=>'122',
                'HouseNumber'=>'A101',
                'Street'=>'Nehuru Street',
                'City'=>'Ssnhdbd',
                'State'=>'Odisha',
                'PinOrZipCode'=>'761007',
                'Country'=>'India',
                'AddressTypeId'=>1,
                'userId'=>25,
        ];
    }
}
