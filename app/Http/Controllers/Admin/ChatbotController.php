<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    /**
     * Display a listing of chat messages.
     */
    public function index(Request $request)
    {
        $query = ChatMessage::query()->orderBy('created_at', 'desc');

        // Filtro por sesión
        if ($request->filled('session_id')) {
            $query->where('session_id', 'like', '%' . $request->session_id . '%');
        }

        // Filtro por fecha
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Filtro por sentimiento
        if ($request->filled('sentiment')) {
            $query->where('sentiment', $request->sentiment);
        }

        $messages = $query->paginate(20);

        // Estadísticas
        $stats = [
            'total' => ChatMessage::count(),
            'today' => ChatMessage::whereDate('created_at', today())->count(),
            'week' => ChatMessage::recent(7)->count(),
            'sessions' => ChatMessage::distinct('session_id')->count('session_id'),
        ];

        return view('admin.chatbot.index', compact('messages', 'stats'));
    }

    /**
     * Show the details of a specific chat session.
     */
    public function show($id)
    {
        $message = ChatMessage::findOrFail($id);
        $sessionMessages = ChatMessage::where('session_id', $message->session_id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.chatbot.show', compact('message', 'sessionMessages'));
    }

    /**
     * Remove the specified chat message from storage.
     */
    public function destroy($id)
    {
        $message = ChatMessage::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.chatbot.index')
            ->with('success', 'Mensaje eliminado exitosamente.');
    }

    /**
     * Clear all chat messages.
     */
    public function clear(Request $request)
    {
        if ($request->filled('days')) {
            $days = (int) $request->days;
            $deleted = ChatMessage::where('created_at', '<', now()->subDays($days))->delete();
            return redirect()->route('admin.chatbot.index')
                ->with('success', "Se eliminaron $deleted mensajes anteriores a $days días.");
        }

        return redirect()->route('admin.chatbot.index')
            ->with('error', 'Debe especificar el número de días.');
    }
}
