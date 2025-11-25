@extends('layouts.site')

@section('content')
    <div class="container">
        <h1>Página no encontrada (404)</h1>
        <p>Lo sentimos, la página que buscas no existe.</p>
        <p><a href="{{ url('/') }}">Volver al inicio</a></p>
    </div>
@endsection
