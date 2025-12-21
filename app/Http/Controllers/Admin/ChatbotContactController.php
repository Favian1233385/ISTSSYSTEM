<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatbotContact;

class ChatbotContactController extends Controller
{
    public function index()
    {
        $contacts = ChatbotContact::orderByDesc('created_at')->paginate(30);
        return view('admin.chatbot.contacts', compact('contacts'));
    }
}
