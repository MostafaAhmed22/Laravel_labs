<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Generates a title
            'title' => fake()->sentence(3), 
            
            // Generates a description
            'description' => fake()->paragraphs(3, true), 
            
            // Generates a random dates 
            'created_at' => fake()->dateTimeBetween('-2 year', 'now'),
            'updated_at' => function (array $attributes) {
                return $attributes['created_at'];
            },
        ];
    }
}
