@extends('layouts.app')

@section('content')
<div class="bg-white min-h-screen py-10 px-5 lg:px-20">
    <h1 class="text-3xl font-bold mb-6 text-center">All Menu</h1>

    <form action="/menu" method="GET" class="mb-8 max-w-md mx-auto">
        <input 
            type="text" 
            name="search" 
            placeholder="Search menu or category..." 
            value="{{ request('search') }}"
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500"
        >
    </form>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach($menus as $menu)
            <div class="bg-white rounded-2xl shadow-lg p-4 relative">
                @if($menu->is_new)
                    <span class="absolute top-2 left-2 bg-red-600 text-white text-xs px-2 py-1 rounded">NEW</span>
                @endif
                <img src="{{ asset('storage/' . $menu->img_url) }}" alt="{{ $menu->name }}" class="w-full rounded-xl mb-4">
                <h2 class="text-xl font-semibold">{{ $menu->name }}</h2>
                <p class="text-gray-600 text-sm mb-1">{{ $menu->category->name ?? 'Uncategorized' }}</p>
                <p class="text-gray-600 text-sm mb-4">{{ $menu->description }}</p>
                <div class="flex justify-between items-center">
                    <span class="text-lg font-bold">Rp.{{ number_format($menu->price,) }}</span>
                    
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
