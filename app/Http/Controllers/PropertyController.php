<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PropertyController extends Controller
{
    /**
     * Display the specified property.
     */
    public function show(Property $property): View
    {
        // Load media collections and agent
        $property->load(['agent']);

        $images = $property->getMedia('images');
        $videos = $property->getMedia('videos');

        return view('properties.show', compact('property', 'images', 'videos'));
    }
}
