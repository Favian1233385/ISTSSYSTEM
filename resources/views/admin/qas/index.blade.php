@extends('layouts.admin')

@section('content')
<style>
    .tabs-container {
        margin-bottom: 2rem;
    }
    
    .tabs {
        display: flex;
        gap: 0.5rem;
        border-bottom: 2px solid #e0e0e0;
        margin-bottom: 2rem;
    }
    
    .tab-button {
        padding: 1rem 2rem;
        background: transparent;
        border: none;
        border-bottom: 3px solid transparent;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 600;
        color: #666;
        transition: all 0.3s ease;
    }
    
    .tab-button:hover {
        color: #00a86b;
        background: #f8f9fa;
    }
    
    .tab-button.active {
        color: #00a86b;
        border-bottom-color: #00a86b;
    }
    
    .tab-content {
        display: none;
    }
    
    .tab-content.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .stat-card-small {
        background: white;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        text-align: center;
    }
    
    .stat-card-small h5 {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }
    
    .stat-card-small .number {
        font-size: 2rem;
        font-weight: 700;
        color: #00a86b;
    }

    .card-table {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px 0 rgba(37,99,235,0.10);
        padding: 2.2rem 2.2rem 1.5rem 2.2rem;
        max-width: 1100px;
        margin: 2.5rem auto 0 auto;
    }
    .card-table table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .card-table th {
        background: #f3f6fd;
        color: #2563eb;
        font-weight: 700;
        font-size: 1.08rem;
        padding: 12px 8px;
        border-bottom: 2px solid #e0e7ef;
        text-align: left;
    }
    .card-table td {
        padding: 13px 8px;
        font-size: 1.01rem;
        border-bottom: 1px solid #f1f5fa;
        vertical-align: middle;
    }
    .actions { display: flex; gap: 10px; align-items: center; }
    .btn-edit {
        background: #2563eb;
        color: #fff;
        border: none;
        padding: 8px 22px;
        border-radius: 6px;
        font-size: 1rem;
        font-weight: 600;
        transition: background 0.2s;
        min-width: 110px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(37,99,235,0.08);
    }
    .btn-edit:hover { background: #1746a2; color: #fff; }
    .btn-danger {
        background: #e53935;
        color: #fff;
        border: none;
        padding: 8px 22px;
        border-radius: 6px;
        font-size: 1rem;
        font-weight: 600;
        transition: background 0.2s;
        min-width: 110px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(229,57,53,0.08);
    }
    .btn-danger:hover { background: #b71c1c; color: #fff; }
    @media (max-width: 1100px) {
        .card-table { padding: 1.2rem 0.5rem; }
    }
    @media (max-width: 700px) {
        .card-table { padding: 0.5rem 0.1rem; }
        .card-table th, .card-table td { font-size: 0.97rem; padding: 8px 4px; }
        .btn-edit, .btn-danger { padding: 7px 10px; min-width: 80px; font-size: 0.95rem; }
    }
</style>

<div class="admin-content">
    <div class="dashboard-header">
        <h1>🤖 Gestión del Chatbot</h1>
        <p>Administra las preguntas/respuestas y revisa las conversaciones del chatbot.</p>
    </div>
    
    <!-- Tabs Navigation -->
    <div class="tabs-container">
        <div class="tabs">
            <button class="tab-button active" onclick="switchTab('qa')">
                📚 Preguntas y Respuestas
            </button>
            <button class="tab-button" onclick="switchTab('messages')">
                💬 Historial de Conversaciones
            </button>
            <button class="tab-button" onclick="switchTab('contacts')">
                📇 Contactos Chatbot
            </button>
        </div>
    </div>
    
    <!-- Tab Content: Q&A -->
    <div id="qa-content" class="tab-content active">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h2>📚 Base de Conocimiento</h2>
            <a href="{{ route('admin.qas.create') }}" class="btn btn-primary">➕ Añadir Q&A</a>
        </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card-table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pregunta (Palabras clave)</th>
                    <th>Respuesta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->question }}</td>
                        <td>{!! Str::limit(strip_tags(html_entity_decode($item->answer)), 100) !!}</td>
                        <td class="actions">
                            <a href="{{ route('admin.qas.edit', $item) }}" class="btn-edit">Editar</a>
                            <form action="{{ route('admin.qas.destroy', $item) }}" method="POST" style="display:inline; margin:0;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este Q&A?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

        <!-- Paginación -->
        {{ $items->links() }}
    </div>
    
    <!-- Tab Content: Messages History -->
    <div id="messages-content" class="tab-content">
        <h2>💬 Historial de Conversaciones</h2>
        <p class="text-muted mb-4">Revisa las conversaciones que los usuarios han tenido con el chatbot.</p>
        <form action="{{ route('admin.qas.clearHistory') }}" method="POST" style="margin-bottom: 1.5rem;">
            @csrf
            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas borrar todo el historial de conversaciones? Esta acción no se puede deshacer.');">
                🗑️ Limpiar historial de conversaciones
            </button>
        </form>
        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card-small">
                <h5>Total Mensajes</h5>
                <div class="number">{{ \App\Models\ChatMessage::count() }}</div>
            </div>
            <div class="stat-card-small">
                <h5>Hoy</h5>
                <div class="number">{{ \App\Models\ChatMessage::whereDate('created_at', today())->count() }}</div>
            </div>
            <div class="stat-card-small">
                <h5>Esta Semana</h5>
                <div class="number">{{ \App\Models\ChatMessage::where('created_at', '>=', now()->subDays(7))->count() }}</div>
            </div>
            <div class="stat-card-small">
                <h5>Sesiones Únicas</h5>
                <div class="number">{{ \App\Models\ChatMessage::distinct('session_id')->count('session_id') }}</div>
            </div>
        </div>
        
        <!-- Messages Table -->
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Sesión</th>
                        <th>Mensaje Usuario</th>
                        <th>Respuesta Bot</th>
                        <th>Sentimiento</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $recentMessages = \App\Models\ChatMessage::orderBy('created_at', 'desc')->take(50)->get();
                    @endphp
                    @forelse($recentMessages as $message)
                        <tr>
                            <td>{{ $message->id }}</td>
                            <td><small class="text-muted">{{ Str::limit($message->session_id, 12) }}</small></td>
                            <td>{{ Str::limit($message->user_message, 50) }}</td>
                            <td>{{ Str::limit($message->bot_response, 50) }}</td>
                            <td>
                                @if($message->sentiment == 'positive')
                                    <span class="badge bg-success">😊 Positivo</span>
                                @elseif($message->sentiment == 'negative')
                                    <span class="badge bg-danger">😞 Negativo</span>
                                @else
                                    <span class="badge bg-secondary">😐 Neutral</span>
                                @endif
                            </td>
                            <td><small>{{ $message->created_at->format('d/m/Y H:i') }}</small></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No hay mensajes registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="alert alert-info mt-3">
            <strong>ℹ️ Nota:</strong> Se muestran los últimos 50 mensajes. Para ver el historial completo con filtros avanzados, 
            <a href="{{ route('admin.chatbot.index') }}" class="alert-link">accede a la vista completa de mensajes</a>.
        </div>
    </div>

    <!-- Tab Content: Contactos Chatbot -->
    <div id="contacts-content" class="tab-content">
        @include('admin.chatbot.contacts_block', ['contacts' => $contacts])
    </div>
</div>

<script>
function switchTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.remove('active');
    });
    
    // Remove active class from all buttons
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active');
    });
    
    // Show selected tab content
    document.getElementById(tabName + '-content').classList.add('active');
    
    // Add active class to clicked button
    event.target.classList.add('active');
}
</script>

@endsection
