@extends('layouts.admin')

@section('title', 'Mensajes del Chatbot')

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-info d-flex justify-content-between align-items-center">
                <div>
                    <strong>¿Deseas configurar el asistente virtual?</strong> Puedes editar el mensaje de bienvenida, mensaje genérico y contactos desde la <a href="{{ route('admin.chatbot-settings.edit') }}" class="alert-link">Configuración del Chatbot</a>.
                </div>
                <a href="{{ route('admin.chatbot-settings.edit') }}" class="btn btn-primary btn-sm">Ir a configuración</a>
            </div>
        </div>
    </div>
    <!-- Aquí continúa la gestión de mensajes del chatbot (historial, filtros, etc.) si lo necesitas -->
</div>
@endsection
