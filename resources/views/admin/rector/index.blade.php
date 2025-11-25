@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Rectoría</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($rector)
        <div class="card">
            <div class="card-body">
                <h3>{{ $rector->name }}</h3>
                @if(!empty($rector->position) || !empty($rector->academic_title))
                    <p class="text-muted">
                        @if(!empty($rector->position))<strong>{{ $rector->position }}</strong>@endif
                        @if(!empty($rector->position) && !empty($rector->academic_title)) — @endif
                        @if(!empty($rector->academic_title)){{ $rector->academic_title }}@endif
                    </p>
                @endif
                @if($rector->image_path)
                    <img src="{{ asset('storage/' . $rector->image_path) }}" alt="Rector" style="max-width:200px;">
                @endif
                <p>{{ Str::limit($rector->message, 250) }}</p>
                <a href="{{ route('admin.contents.rector.edit') }}" class="btn btn-primary">Editar</a>
            </div>
        </div>
    @else
        <p>No hay información del rector todavía.</p>
        <a href="{{ route('admin.contents.rector.create') }}" class="btn btn-primary">Crear</a>
    @endif
</div>
@endsection
