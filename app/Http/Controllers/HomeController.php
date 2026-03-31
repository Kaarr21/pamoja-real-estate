<?php

namespace App\Http\Controllers;

use App\Enums\PropertyStatus;
use App\Models\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $forSale = Property::where('status', PropertyStatus::FOR_SALE)->latest()->take(3)->get();
        $forRent = Property::where('status', PropertyStatus::RENTED)->latest()->take(3)->get();
        $sold = Property::where('status', PropertyStatus::SOLD)->latest()->take(3)->get();

        return view('home.index', compact('forSale', 'forRent', 'sold'));
    }
}
