<?php

namespace App\Http\Controllers;

class TripsController extends Controller
{
    public function index($slug = null)
    {
        abort_if($slug === null, 404);
        abort_if(!file_exists(storage_path('trips/'.$slug.'.json')), 404);

        $trip = json_decode(file_get_contents(storage_path('trips/'.$slug.'.json')), true);

        $entries = collect($trip['entries'])->where('visibility', 1);

        return view('trip', compact('trip', 'slug', 'entries'));
    }
}
