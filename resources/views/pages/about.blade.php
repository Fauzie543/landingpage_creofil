@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white py-12 px-6 lg:px-20 max-w-5xl mx-auto">
    <h1 class="text-3xl font-bold mb-8 text-center">About Us</h1>

    @if($about)
        @if($about->img_url)
            <div class="mb-6 text-center">
                <img src="{{ asset('storage/' . $about->img_url) }}" alt="About Image"
                    class="mx-auto rounded-lg max-h-80 object-cover shadow-md">
            </div>
        @endif

        <h2 class="text-2xl font-semibold mb-2 text-center">{{ $about->title }}</h2>
        <p class="text-gray-700 leading-relaxed text-justify">
            {{ $about->description }}
        </p>
    @else
        <p class="text-center text-gray-500">About Us content is not available.</p>
    @endif
</div>
@endsection
