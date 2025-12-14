@extends('public.layout')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Calendario de Eventos</h1>
    <div id="calendar"></div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<style>
    #calendar {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        padding: 1rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            events: @json($calendarEvents),
            eventClick: function(info) {
                window.location.href = info.event.url;
                info.jsEvent.preventDefault();
            }
        });
        calendar.render();
    });
</script>
@endpush
