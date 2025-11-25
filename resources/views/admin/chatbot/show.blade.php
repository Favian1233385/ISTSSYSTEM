@extends('layouts.admin')

@section('title', 'Detalles de Conversación')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">💬 Detalles de Conversación</h1>
                <a href="{{ route('admin.chatbot.index') }}" class="btn btn-secondary">
                    ← Volver al Listado
                </a>
            </div>
        </div>
    </div>

    <!-- Información de la sesión -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">📋 Información de la Sesión</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>ID de Sesión:</strong> <code>{{ $message->session_id }}</code></p>
                    <p><strong>IP del Usuario:</strong> {{ $message->ip_address }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Total de Mensajes:</strong> {{ $sessionMessages->count() }}</p>
                    <p><strong>Fecha de Inicio:</strong> {{ $sessionMessages->first()->created_at->format('d/m/Y H:i:s') }}</p>
                </div>
            </div>
            <details class="mt-2">
                <summary style="cursor: pointer;" class="text-muted">
                    <small>🔍 Ver User Agent</small>
                </summary>
                <small class="text-muted d-block mt-2">{{ $message->user_agent }}</small>
            </details>
        </div>
    </div>

    <!-- Conversación completa -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">💬 Historial de Conversación</h5>
        </div>
        <div class="card-body">
            <div class="chat-container" style="max-height: 600px; overflow-y: auto;">
                @foreach($sessionMessages as $msg)
                <!-- Mensaje del usuario -->
                <div class="mb-4">
                    <div class="d-flex align-items-start">
                        <div class="me-3">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 40px; height: 40px;">
                                👤
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="bg-light p-3 rounded">
                                <p class="mb-1">{{ $msg->user_message }}</p>
                                <small class="text-muted">
                                    {{ $msg->created_at->format('d/m/Y H:i:s') }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Respuesta del bot -->
                <div class="mb-4">
                    <div class="d-flex align-items-start flex-row-reverse">
                        <div class="ms-3">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 40px; height: 40px;">
                                🤖
                            </div>
                        </div>
                        <div class="flex-grow-1 text-end">
                            <div class="bg-success bg-opacity-10 p-3 rounded text-start">
                                <p class="mb-1">{{ $msg->bot_response }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        {{ $msg->created_at->format('d/m/Y H:i:s') }}
                                    </small>
                                    @if($msg->sentiment)
                                        <span class="badge bg-{{ $msg->sentiment == 'positive' ? 'success' : ($msg->sentiment == 'negative' ? 'danger' : 'secondary') }}">
                                            {{ $msg->sentiment == 'positive' ? '😊 Positivo' : ($msg->sentiment == 'negative' ? '😞 Negativo' : '😐 Neutral') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(!$loop->last)
                <hr class="my-3">
                @endif
                @endforeach
            </div>
        </div>
    </div>

    <!-- Acciones -->
    <div class="card mt-4">
        <div class="card-body">
            <form action="{{ route('admin.chatbot.destroy', $message->id) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('¿Está seguro de eliminar toda esta conversación?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    🗑️ Eliminar esta Conversación
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
