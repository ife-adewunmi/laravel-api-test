<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Seeder;

class HotelsSeeder extends Seeder
{
    public function run()
    {
        // Create active Hotels without any Reviews
        Hotel::factory()
            ->count(5)
            ->create();

        // Create active Hotels with Reviews
        Hotel::factory()
            ->count(5)
            ->hasReviews(5)
            ->create();

        // Create inactive Hotels
        Hotel::factory()
            ->inactive()
            ->count(5)
            ->create();
    }
}
