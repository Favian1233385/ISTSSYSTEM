@extends('layouts.site')

@section('content')
<div class="content-detail">
    <div class="container">
        <div class="page-header">
            <h1>{{ $section->title }}</h1>
            @if($section->description)
                <p class="lead">{{ $section->description }}</p>
            @endif
        </div>

        <div class="content-body">
            @if($section->image_path)
                <div class="section-image">
                    <img src="{{ asset('storage/' . $section->image_path) }}" alt="{{ $section->title }}" class="img-fluid">
                </div>
            @endif

            @if($section->content)
                <div class="section-content">
                    {!! $section->content !!}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection