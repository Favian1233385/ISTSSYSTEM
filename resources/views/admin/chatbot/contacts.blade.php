@extends('admin.layout')

@section('title', 'Contactos del Chatbot')

@section('content')
<div class="container py-4">
    @include('admin.chatbot.contacts_block', ['contacts' => $contacts])
</div>
@endsection
