<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Menu::with('category');

        // Jika ada pencarian, filter berdasarkan nama menu atau nama kategori
        if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%'])
        ->orWhereHas('category', function ($q2) use ($search) {
          $q2->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
            });
        
}

        $menus = $query->get();

        return view('pages.menu', compact('menus'))->with('search', $request->search);
    }
}