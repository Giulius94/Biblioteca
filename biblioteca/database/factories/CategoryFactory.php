<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['Horror', 'Fantasy', 'Fiction', 'Romance', 'Mystery', 'History'];
        return [
            'name' => fake()->randomElement($categories),
            'created_at' => fake()->datetime(),
            'book_id' => Book::get()->random()->id
        ];
    }
}
