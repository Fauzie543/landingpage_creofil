@php
    use App\Models\Company;
    $company = Company::first();
@endphp

<nav class="bg-white border-b border-gray-200 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <!-- Left Menu -->
            <div class="flex gap-8">
                <a href="{{ route('menu') }}" class="text-gray-700 hover:text-black font-medium">Menu</a>
                <a href="{{ route('about') }}" class="text-gray-700 hover:text-black font-medium">About Us</a>
            </div>

            <!-- Logo in the Center -->
            <div>
                @if ($company && $company->img_url)
                <a href="{{ route('landing') }}">
                    <img src="{{ asset('storage/' . $company->img_url) }}"
                         alt="{{ $company->name }}"
                         class="h-12 mx-auto object-contain" />
                </a>
                @else
                    <a href="{{ route('landing') }}" class="text-xl font-bold hover:underline">
                        Company
                    </a>
                @endif
            </div>

            <!-- Right Menu -->
            <div class="flex gap-8">
                <a href="{{ route('event') }}" class="text-gray-700 hover:text-black font-medium">Event</a>
                <a href="{{ route('contact') }}" class="text-gray-700 hover:text-black font-medium">Contact Us</a>
            </div>
        </div>
    </div>
</nav>
