<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatbotContact;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ChatbotContactsExport;

class ChatbotContactController extends Controller
{
    public function index()
    {
        $contacts = ChatbotContact::orderByDesc('created_at')->paginate(30);
        return view('admin.chatbot.contacts', compact('contacts'));
    }

    public function exportExcel()
    {
        return Excel::download(new ChatbotContactsExport, 'contactos_chatbot.xlsx');
    }

    public function destroyAll()
    {
        ChatbotContact::truncate();
        return redirect()->route('admin.chatbot.contacts')->with('success', 'Todos los contactos han sido eliminados.');
    }
}
