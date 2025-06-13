<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poster;
use App\Models\LandingContent;
use App\Models\Menu;

class LandingController extends Controller
{
    public function index()
    {
        $posters = Poster::all();
        $contents = LandingContent::all();
        $menus = Menu::all();

        return view('index', compact('posters', 'contents', 'menus'));
    }
}