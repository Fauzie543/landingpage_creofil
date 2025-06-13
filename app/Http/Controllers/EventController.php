<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $today = Carbon::now();

        $upcomingEvents = Event::where('start_time', '>=', $today)
        ->orderBy('start_time')
        ->get();
        
        $nextEvent = Event::where('start_time', '>=', now())
                          ->orderBy('start_time', 'asc')
                          ->first();

        $allEvents = $upcomingEvents->map(function ($event) {
            return [
                'title' => $event->title,
                'start' => $event->start_time,
                'end'   => $event->end_time,
                'extendedProps' => [
                    'poster_image' => $event->poster_image ? asset('storage/' . $event->poster_image) : null,
                    'location' => $event->location,
                ]
            ];
        });

        return view('pages.event', compact('nextEvent', 'allEvents', 'upcomingEvents'));
    }
}