<?php

use Illuminate\Support\Facades\Route;

Route::get('hotels/{id}', 'HotelsController@find')->name('api.hotels.find');
