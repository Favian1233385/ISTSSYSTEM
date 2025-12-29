<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatbotContact;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ChatbotContactsExport;

class ChatbotContactController extends Controller
{
    public function index(Request $request)
    {
        $query = ChatbotContact::query();
        // Filtro por nombre o teléfono
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'like', "%$search%")
                  ->orWhere('telefono', 'like', "%$search%") ;
            });
        }
        // Filtro por carrera
        if ($request->filled('carrera')) {
            $query->where('carrera', $request->input('carrera'));
        }
        $contacts = $query->select(['id', 'nombre', 'telefono', 'carrera', 'created_at'])
            ->orderByDesc('created_at')
            ->paginate(25)
            ->appends($request->all());

        if ($request->ajax()) {
            return view('admin.chatbot.contacts_table', compact('contacts'))->render();
        }
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
