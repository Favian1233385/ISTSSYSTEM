@extends('public.layout')

@section('header')
    <header class="bg-emerald-700 py-8 mb-8 shadow-lg">
        <div class="max-w-5xl mx-auto px-4">
            <h1 class="text-3xl md:text-4xl font-bold text-white text-center drop-shadow">Índice A-Z Institucional</h1>
            <p class="text-emerald-100 text-center mt-2">Encuentra personas, carreras, servicios, autoridades y más.</p>
        </div>
    </header>
@endsection

@section('content')
<div class="max-w-5xl mx-auto mb-8">
    <input type="text" id="az-search" class="form-control mb-5" placeholder="Buscar por nombre, tipo, área, etc..." style="font-size:1.1rem; padding:0.8rem 1.2rem; border-radius:12px; border:1px solid #cbd5e1;">
    <div id="az-results">
        <!-- Resultados agrupados -->
        <h2 class="text-xl font-bold mt-8 mb-3 text-emerald-800">Personas</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            @foreach($personas as $p)
                <div class="bg-white rounded-lg shadow p-4 flex items-center gap-4 az-item" data-type="persona" data-name="{{ strtolower($p->name ?? ($p->first_name.' '.$p->last_name)) }}" data-role="{{ strtolower($p->role ?? '') }}">
                    <span class="inline-block bg-emerald-600 text-white text-xs font-bold px-3 py-1 rounded-full mr-2">Persona</span>
                    <div>
                        <div class="font-semibold">{{ $p->name ?? ($p->first_name.' '.$p->last_name) }}</div>
                        <div class="text-gray-500 text-sm">{{ $p->role ?? '-' }}</div>
                        <div class="text-gray-400 text-xs">{{ $p->email }}</div>
                    </div>
                </div>
            @endforeach
        </div>
        <h2 class="text-xl font-bold mt-8 mb-3 text-emerald-800">Carreras</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            @foreach($carreras as $c)
                <div class="bg-white rounded-lg shadow p-4 flex items-center gap-4 az-item" data-type="carrera" data-name="{{ strtolower($c->name) }}">
                    <span class="inline-block bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full mr-2">Carrera</span>
                    <div>
                        <div class="font-semibold">{{ $c->name }}</div>
                        <div class="text-gray-500 text-sm">{{ $c->code ?? '' }}</div>
                    </div>
                </div>
            @endforeach
        </div>
        <h2 class="text-xl font-bold mt-8 mb-3 text-emerald-800">Áreas y Servicios</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            @foreach($secciones as $s)
                <div class="bg-white rounded-lg shadow p-4 flex items-center gap-4 az-item" data-type="seccion" data-name="{{ strtolower($s->name) }}">
                    <span class="inline-block bg-purple-600 text-white text-xs font-bold px-3 py-1 rounded-full mr-2">Sección</span>
                    <div>
                        <div class="font-semibold">{{ $s->name }}</div>
                    </div>
                </div>
            @endforeach
            @foreach($servicios as $srv)
                <div class="bg-white rounded-lg shadow p-4 flex items-center gap-4 az-item" data-type="servicio" data-name="{{ strtolower($srv->title) }}">
                    <span class="inline-block bg-pink-600 text-white text-xs font-bold px-3 py-1 rounded-full mr-2">Servicio</span>
                    <div>
                        <div class="font-semibold">{{ $srv->title }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const search = document.getElementById('az-search');
        search.addEventListener('input', function() {
            const val = this.value.toLowerCase();
            document.querySelectorAll('.az-item').forEach(function(item) {
                const name = item.getAttribute('data-name') || '';
                const type = item.getAttribute('data-type') || '';
                const role = item.getAttribute('data-role') || '';
                if (name.includes(val) || type.includes(val) || role.includes(val)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection
