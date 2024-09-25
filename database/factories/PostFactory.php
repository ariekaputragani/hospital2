<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => rand(1,3),
            'author_id' => rand(1,1),
            'title' => $faker->sentence(),
            'slug' => \Str::slug($faker->sentence()),
            'body' => $faker->paragraph(10),
        ];
    }
}
