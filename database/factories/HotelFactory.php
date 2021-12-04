<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelFactory extends Factory
{
    protected $model = Hotel::class;

    public function definition()
    {
        return [
            'name' => $this->faker->colorName . ' ' . $this->faker->monthName,
            'address' => $this->faker->address,
            'supplier' => $this->faker->randomElement(['Own', 'HotelBeds', 'SunHotels']),
            'active' => true,
        ];
    }

    public function inactive()
    {
        return $this->state(function () {
            return [
                'active' => false,
            ];
        });
    }
}
