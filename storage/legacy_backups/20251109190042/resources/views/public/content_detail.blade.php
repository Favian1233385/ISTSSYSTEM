@extends('layouts.site')

@section('content')
    <div class="container">
        <h1>{{ $content['title'] ?? 'Contenido' }}</h1>
        <p>{{ $content['description'] ?? '' }}</p>
        <div>{!! $content['body'] ?? '' !!}</div>
    </div>
@endsection
