<?php

namespace App\Http\Controllers;

use App\Models\Hotel;

class HotelsController extends Controller
{
    public function find(int $id)
    {
        $hotel = Hotel::with('reviews')
            ->active()
            ->select(['id', 'name'])
            ->findOrFail($id);

        return response(compact('hotel'));
    }
}
