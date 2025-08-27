<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createdAt = $this->faker->dateTimeBetween('-2 years');
        return [
            'book_id' => Book::factory(),
            'review' => $this->faker->paragraph(),
            'rating' => $this->faker->numberBetween(1, 5),
            'created_at' => $createdAt,
            'updated_at' => $this->faker->dateTimeBetween($createdAt, 'now'),
        ];
    }

    public function average()
    {
        return $this->state(function (array $attibutes) {
            return [
                'rating' => $this->faker->numberBetween(2, 5)
            ];
        });
    }

    public function good()
    {
        return $this->state(function (array $attibutes) {
           return [
                'rating' => $this->faker->numberBetween(4, 5)
           ];
        });
    }

    public function bad()
    {
        return $this->state(function (array $attibutes) {
            return [
                'rating' => $this->faker->numberBetween(1, 3)
            ];
        });
    }
}
