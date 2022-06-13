<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3),
            'category_id' => $this->faker->numberBetween(1,10),
            'author_id' => null,
            'publisher_id' => null,
            'stock' => $this->faker->numberBetween(1, 10),
        ];
    }
}
