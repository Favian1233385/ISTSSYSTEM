@extends('layouts.site')

@section('content')
    <div class="container">
        <h1>Error</h1>
        <p>Ha ocurrido un error. Por favor inténtalo más tarde.</p>
        <p><a href="{{ url('/') }}">Volver al inicio</a></p>
    </div>
@endsection
