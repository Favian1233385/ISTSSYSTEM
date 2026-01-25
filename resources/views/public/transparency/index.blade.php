@extends('public.layout')
{{ esto_es_un_error_blade_no_borrar }}

@section('content')
{{-- Vista limpia de transparencia --}}
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="margin-top:100px;">
    <div class="p-6 text-gray-900">
        <div class="career-title-container text-center" style="margin-bottom:2.5rem;">
            <h1 class="text-4xl font-bold mb-6">{{ $title }}</h1>
        </div>
        <div style="display: flex; gap: 2rem; align-items: flex-start;">
            <div style="flex: 0 0 320px; max-width: 320px; background: #f6f6f6; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); padding: 1rem; display: flex; justify-content: center; align-items: center;">
                @php
                    $imgPath = $items[0]['image_url'] ?? null;
                    // Eliminar cualquier 'storage/' al inicio de la ruta
                    if ($imgPath) {
                        $imgPath = preg_replace('#^/?storage/#', '', $imgPath);
                    }
                    $imgSrc = !empty($imgPath) ? $imgPath : asset('assets/img/institucional-placeholder.png');
                @endphp
                <img src="/{{ $imgSrc }}" alt="{{ $title }}" style="max-width: 100%; max-height: 260px; border-radius: 8px; object-fit: cover;">
            </div>
            <div style="flex: 1; background: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); padding: 1.5rem;">
                <p style="font-size:1.15rem; color:#222; margin-bottom:2.5rem;">{{ $items[0]['description'] ?? '' }}</p>
            </div>
        </div>
        <div class="subreglamentos-list mt-8" style="text-align:center;">
            <h2 class="text-2xl font-bold mb-4" style="color:#009e60; text-align:center;">Documentos</h2>
            <ul style="display:inline-block; text-align:left;">
                @foreach(($items[0]['children'] ?? []) as $child)
                    <li class="mb-2" style="font-size:1.05rem; font-weight:600; color:#006400; text-align:center;">
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