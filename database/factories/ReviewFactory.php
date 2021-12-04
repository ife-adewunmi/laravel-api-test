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
            'rating' => $this->getRandomRating(),
            'author' => $this->faker->name,
        ];
    }

    private function getRandomRating(): float
    {
        $random = rand() / getrandmax();
        return round(($random * 4) + 1, 1);
    }
}
