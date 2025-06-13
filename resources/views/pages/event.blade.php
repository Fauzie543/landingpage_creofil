@extends('layouts.app')

@section('content')
<div class="bg-white min-h-screen py-10 px-5 lg:px-20">
    <h1 class="text-3xl font-bold mb-6 text-center">Join Us! Next Schedule:</h1>

    @if($upcomingEvents->count() > 0)
    <div x-data="{ activeSlide: 0, total: {{ $upcomingEvents->count() }} }" x-init="setInterval(() => activeSlide = (activeSlide + 1) % total, 4000)" class="relative overflow-hidden max-w-3xl mx-auto mb-10">
        <template x-for="(event, index) in {{ $upcomingEvents->toJson() }}" :key="index">
            <div x-show="activeSlide === index" class="transition-all duration-700 ease-in-out">
                <div class="text-center">
                    <img :src="'/storage/' + event.poster_image" alt="Poster" class="rounded-xl mx-auto mb-4 max-h-[400px] object-cover w-full">
                    <p class="text-lg font-semibold" x-text="event.title"></p>
                    <p class="text-sm text-gray-500" x-text="new Date(event.start_time).toLocaleString('en-GB', { day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' }) + ' - ' + event.location"></p>
                </div>
            </div>
        </template>
    </div>
    @else
        <p class="text-center text-gray-500 mb-10">No upcoming events</p>
    @endif


    <h2 class="text-2xl font-semibold mb-4 text-center">Upcoming Events</h2>

    <div id="calendar" class="bg-white p-2 rounded-lg shadow-md text-sm" style="min-height: 300px; font-size: 0.85rem;"></div>

</div>
@endsection

@push('styles')
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
@endpush

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    let calendarEl = document.getElementById('calendar');

    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 'auto',
        events: @json($allEvents),
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: ''
        },
        eventClick: function(info) {
            const poster = document.getElementById('eventPoster');
            const title = document.getElementById('eventTitle');
            const timeLocation = document.getElementById('eventTimeLocation');

            if (poster && info.event.extendedProps.poster_image) {
                poster.src = info.event.extendedProps.poster_image;
            }

            if (title) {
                title.textContent = info.event.title;
            }

            if (timeLocation) {
                const eventStart = new Date(info.event.start);
                const dateOptions = { day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' };
                const formatted = eventStart.toLocaleString('en-GB', dateOptions);
                const location = info.event.extendedProps.location || '';
                timeLocation.textContent = `${formatted} - ${location}`;
            }

            // Optional: Scroll ke atas
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });

            info.jsEvent.preventDefault();
        }
    });

    calendar.render();
});
</script>


@endpush
