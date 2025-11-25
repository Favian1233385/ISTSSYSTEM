<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TimelineEvent;

class TimelineEventController extends Controller
{
    // Middleware de autenticación / autorización asumido (usar 'auth' y rol admin)
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $events = TimelineEvent::orderBy('year','asc')->orderBy('order','asc')->get();
        return view('admin.timeline.index', compact('events'));
    }

    public function create()
    {
        return view('admin.timeline.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'year' => 'required|integer',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_public' => 'nullable|boolean',
        ]);

        $data['is_public'] = $request->has('is_public');

        TimelineEvent::create($data);

        return redirect()->route('admin.timeline.index')->with('success','Evento creado.');
    }

    public function edit(TimelineEvent $timelineEvent)
    {
        return view('admin.timeline.edit', ['event' => $timelineEvent]);
    }

    public function update(Request $request, TimelineEvent $timelineEvent)
    {
        $data = $request->validate([
            'year' => 'required|integer',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_public' => 'nullable|boolean',
        ]);

        $data['is_public'] = $request->has('is_public');

        $timelineEvent->update($data);

        return redirect()->route('admin.timeline.index')->with('success','Evento actualizado.');
    }

    public function destroy(TimelineEvent $timelineEvent)
    {
        $timelineEvent->delete();
        return redirect()->route('admin.timeline.index')->with('success','Evento eliminado.');
    }
}
