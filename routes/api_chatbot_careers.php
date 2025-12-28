<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ...otros endpoints...

// Endpoint para obtener todas las carreras activas
Route::get('/chatbot/carreras', function () {
    $careers = \App\Models\Career::active()->ordered()->get(['id', 'name']);
    return response()->json([
        'careers' => $careers
    ]);
});
