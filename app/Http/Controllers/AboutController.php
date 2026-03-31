<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $aboutContent = PageContent::where('slug', 'about-us')
            ->where('is_active', true)
            ->first();

        return view('about.index', [
            'about' => $aboutContent,
        ]);
    }
}
