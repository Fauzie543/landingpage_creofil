<?php

namespace App\Http\Controllers;

use App\Models\LandingContent;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function show()
    {
        $about = LandingContent::first(); // Ambil 1 data about us
        return view('pages.about', compact('about'));
    }
}