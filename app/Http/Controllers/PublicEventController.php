<?php
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class PublicEventController extends Controller
{
    public function index()
    {
        $today = now()->startOfDay();
        $events = Event::where('status', 'published')
            ->whereDate('date', '>=', $today)
            ->orderBy('date', 'asc')
            ->paginate(9);
        return view('public.events.index', compact('events'));
    }

    public function show($id)
    {
        $event = Event::with(['images', 'files', 'links'])->where('status', 'published')->findOrFail($id);
        return view('public.events.show', compact('event'));
    }

    public function calendar()
    {
        $events = \App\Models\Event::where('status', 'published')->get();
        $calendarEvents = $events->map(function($event) {
            return [
                'title' => $event->title,
                'start' => $event->date->format('Y-m-d'),
                'url' => route('public.events.show', $event->id),
            ];
        });
        return view('public.events.calendar', [
            'calendarEvents' => $calendarEvents
        ]);
    }
}
