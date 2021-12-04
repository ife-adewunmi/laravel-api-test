<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        return [
            'title' => $this->faker->text(50),
            'description' => $this->faker->text(), 
            'rating' => random_int(1, 5),
            'author' => $this->faker->name,
        ];
    }
}
