@extends('public.layout')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="margin-top:100px; border: 4px solid red;">
    <div style="background: #ff0000; color: #fff; font-size: 2rem; text-align: center; padding: 1rem;">PRUEBA DE MODIFICACIÓN - SI VES ESTO, EL ARCHIVO ES CORRECTO</div>
    <div class="p-6 text-gray-900">
        <div class="career-title-container text-center" style="margin-bottom:2.5rem;">
            <h1 class="text-4xl font-bold mb-6">{{ $title }}</h1>
        </div>
        <div class="flex flex-col md:flex-row items-center gap-8">
            @if(isset($items[0]['image']))
            <div class="content-image mb-6 md:mb-0" style="max-width:300px;">
                <img src="{{ asset('storage/'.$items[0]['image']) }}" alt="{{ $title }}" style="border-radius:16px; box-shadow:0 2px 8px rgba(0,0,0,0.10); width:100%; max-width:300px;">
            </div>
            @endif
            <div class="flex-1">
                <p style="font-size:1.15rem; color:#222; margin-bottom:2.5rem;">{{ $items[0]['description'] ?? '' }}</p>
            </div>
        </div>
        <div class="subreglamentos-list mt-8">
            <h2 class="text-2xl font-bold mb-4" style="color:#1976d2;">Subreglamentos</h2>
            <ul>
                @foreach(($items[0]['children'] ?? []) as $child)
                    <li class="mb-2" style="font-size:1.05rem; font-weight:600; color:#006400;">
                        <span style="font-weight:700;">{{ $child['title'] }}</span>
                        @if(!empty($child['pdf_url']))
                            <a href="{{ asset('storage/'.$child['pdf_url']) }}" target="_blank" class="btn btn-primary btn-sm mx-2">Ver PDF</a>
                            <a href="{{ asset('storage/'.$child['pdf_url']) }}" download class="btn btn-link btn-sm">Descargar PDF</a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection