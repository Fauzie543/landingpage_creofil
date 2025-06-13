@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white py-10 px-4 lg:px-20 max-w-7xl mx-auto">
    <h1 class="text-3xl font-bold mb-8 text-center">Contact Us</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-10">
        <!-- Left Side: Feedback Form -->
        <div class="bg-gray-50 p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Send us a message</h2>
            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block mb-1 font-medium">Name</label>
                    <input type="text" name="name" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block mb-1 font-medium">Email</label>
                    <input type="email" name="email" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block mb-1 font-medium">Message</label>
                    <textarea name="message" rows="5" class="w-full border rounded p-2" required></textarea>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Submit</button>
            </form>
        </div>

        <!-- Right Side: Company Info -->
        <div class="bg-gray-100 p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Our Info</h2>

            @if($company)
            @if($company && $company->latitude && $company->longitude)
                <div class="mb-4 rounded overflow-hidden">
                    <iframe
                        src="https://www.google.com/maps?q={{ $company->latitude }},{{ $company->longitude }}&output=embed"
                        width="100%"
                        height="200"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            @endif
                <p><strong>Email:</strong> {{ $company->email }}</p>
                <p><strong>Phone:</strong> {{ $company->no_telp }}</p>
                <p><strong>Address:</strong> {{ $company->address }}</p>
                @if($company->instagram)
                    <p><strong>Instagram:</strong>
                        <a href="https://instagram.com/{{ ltrim($company->instagram, ) }}" class="text-blue-600 underline" target="_blank">
                            {{ $company->instagram }}
                        </a>
                    </p>
                @endif
            @else
                <p class="text-gray-500">Company information is not available.</p>
            @endif
        </div>
    </div>
</div>
@endsection
