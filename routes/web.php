<?php

use Illuminate\Support\Facades\Route;

Route::get('/{slug}', [\App\Http\Controllers\TripsController::class, 'index']);
