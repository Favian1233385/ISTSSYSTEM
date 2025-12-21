<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatbotContact;

class ChatbotContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:120',
            'telefono' => 'required|string|max:30',
        ]);

        $contact = ChatbotContact::create($validated);

        return response()->json([
            'success' => true,
            'contact' => $contact
        ], 201);
    }
}
