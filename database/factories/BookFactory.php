<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug(),
            'category_id' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->paragraph,
            'quantity' => $this->faker->numberBetween(0, 100),
            'file_path' => $this->faker->filePath(),
            'cover_path' => $this->faker->imageUrl(),
            'user_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
