@php
use App\Models\AcademicCalendarEvent;
$event = AcademicCalendarEvent::orderBy('start_date', 'asc')->whereDate('end_date', '>=', now())->first();
@endphp
@if($event)
    <div class="footer-calendar-card" style="background: #f9fafb; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); padding: 1rem; margin-top: 1.5rem;">
        <div style="display: flex; align-items: center; gap: 1rem;">
            <div style="font-size: 2rem; color: var(--color-primary);">📆</div>
            <div>
                <div style="font-weight: bold; color: var(--color-primary); font-size: 1.1rem;">{{ $event->title }}</div>
                <div style="color: var(--color-secondary); font-size: 0.95rem;">
                    {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}
                </div>
                @if($event->description)
                    <div style="color: #444; font-size: 0.95rem; margin-top: 0.3rem;">{{ $event->description }}</div>
                @endif
            </div>
        </div>
        <a href="{{ url('/calendario') }}" class="btn btn-primary mt-2" style="margin-top: 1rem; display: inline-block;">Ver Calendario Completo</a>
    </div>
@endif
