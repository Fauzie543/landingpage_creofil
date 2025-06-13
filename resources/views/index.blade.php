@extends('layouts.app')

@section('content')
<div class="bg-white">
    <!-- Top Poster Section -->
    @foreach ($posters as $poster)
        <div class="text-center py-16">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">{{ $poster->name }}</h1>
            <img src="{{ asset('storage/' . $poster->img_url) }}" alt="{{ $poster->title }}" class="mx-auto rounded-md shadow-lg w-full max-w-5xl h-auto">
            <p class="mt-4 text-lg text-gray-600">{{ $poster->description }}</p>
        </div>
    @endforeach

    <!-- Landing Contents Section -->
    <div class="space-y-16 py-16">
        @foreach ($contents as $index => $content)
            <div class="flex flex-col md:flex-row {{ $index % 2 !== 0 ? 'md:flex-row-reverse' : '' }} items-center gap-8 max-w-6xl mx-auto px-4">
                <div class="w-full md:w-1/2">
                    <img src="{{ asset('storage/' . $content->img_url) }}" alt="Image {{ $index }}" class="rounded-lg shadow-md">
                </div>
                <div class="w-full md:w-1/2">
                    <h2 class="text-2xl font-bold mb-2">{{ $content->title }}</h2>
                    <p class="text-gray-600">{{ $content->description }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Menu Section -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-8">Our Menu</h2>
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
                @foreach ($menus as $menu)
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <img src="{{ asset('storage/' . $menu->img_url) }}" alt="{{ $menu->name }}" class="rounded-lg h-48 w-full object-cover mb-4">
                        <h3 class="text-xl font-semibold">{{ $menu->name }}</h3>
                        <p class="text-gray-500">{{ $menu->description }}</p>
                        <p class="text-primary font-bold mt-2">Rp.{{ number_format($menu->price) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection