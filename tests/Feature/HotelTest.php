<?php

namespace Tests\Feature;

use App\Models\Hotel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HotelTest extends TestCase
{
    use RefreshDatabase;

    public function test_resolving_active_hotel()
    {
        $hotel = Hotel::factory()->create();

        $this->getJson(route('api.hotels.find', ['id' => $hotel->id]))
            ->assertOk()
            ->assertJsonStructure([
                'hotel' => [
                    'id',
                    'name',
                    'rating',
                    'reviews',
                ],
            ])
            ->assertJsonCount(0, 'hotel.reviews')
            ->assertSeeText($hotel->name);
    }

    public function test_resolving_active_hotel_with_reviews()
    {
        $hotel = Hotel::factory()
            ->hasReviews(3)
            ->create();

        $this->getJson(route('api.hotels.find', ['id' => $hotel->id]))
            ->assertOk()
            ->assertJsonStructure([
                'hotel' => [
                    'id',
                    'name',
                    'rating',
                    'reviews',
                ],
            ])
            ->assertJsonCount(3, 'hotel.reviews')
            ->assertSeeTextInOrder([
                $hotel->name,
                $hotel->reviews[0]->title,
                $hotel->reviews[1]->title,
                $hotel->reviews[2]->title,
            ]);
    }

    public function test_resolving_inactive_hotel()
    {
        $hotel = Hotel::factory()->inactive()->create();

        $this->getJson(route('api.hotels.find', ['id' => $hotel->id]))
            ->assertNotFound();
    }

    public function test_hotel_rating_matches_with_reviews() {
        $hotel = Hotel::factory()
            ->hasReviews(5)
            ->create();
        
        $average_rating = $hotel->reviews()->avg('rating');
        $average_rating = round($average_rating, 1);

        $this->getJson(route('api.hotels.find', ['id' => $hotel->id]))
            ->assertOk()
            ->assertJson([
                'hotel' => [
                    'rating' => $average_rating,
                ],
            ]);
    }
}
