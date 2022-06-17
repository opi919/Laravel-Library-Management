<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookIssueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(2, 10),
            'book_id' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'issue_date' => $this->faker->dateTimeBetween('-7 days', 'now'),
            'return_date' => $this->faker->dateTimeBetween('now', '+7 days'),
        ];
    }
}
