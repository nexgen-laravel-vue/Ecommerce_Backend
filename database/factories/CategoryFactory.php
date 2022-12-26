<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'categoryName'=>'Pc & Video games',
            'categoryImage'=>'https://media.istockphoto.com/id/1305224036/photo/latin-man-gaming-on-his-pc-during-a-live-stream.jpg?b=1&s=170667a&w=0&k=20&c=sEl-9qE8Mit0iRWpwjYDDwsNSNu196ysnWXYmWQubWE=',
            'parentId'=>5,
            'levelId'=>12
        ];
    }
}
