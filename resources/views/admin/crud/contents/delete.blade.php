@extends('layouts.admin')

@section('content')
<div class="admin-content">
    <div class="dashboard-section">
        <div class="section-header">
            <h2>Confirmar Eliminación</h2>
            <p>Esta acción no se puede deshacer</p>
        </div>

        <div style="padding: 2rem;">
            <div class="delete-warning">
                <div class="warning-icon">⚠️</div>
                <h3>¿Estás seguro de eliminar este contenido?</h3>
                <p>Esta acción eliminará permanentemente el contenido y no se puede deshacer.</p>
            </div>

            <div class="content-preview">
                <h4>Contenido a eliminar:</h4>
                <div class="preview-card">
                    <h5>{{ $content['title'] ?? 'Sin título' }}</h5>
                    <p><strong>Categoría:</strong> {{ ucfirst(str_replace('-', ' ', $content['category'] ?? 'Sin categoría')) }}</p>
                    <p><strong>Estado:</strong> 
                        <span class="badge badge-{{ $content['status'] ?? 'draft' }}">
                            {{ ucfirst($content['status'] ?? 'draft') }}
                        </span>
                    </p>
                    <p><strong>Autor:</strong> {{ $content['author_name'] ?? 'Admin' }}</p>
                    <p><strong>Vistas:</strong> {{ number_format($content['views'] ?? 0) }}</p>
                    <p><strong>Creado:</strong> {{ date('d/m/Y H:i', strtotime($content['created_at'] ?? '')) }}</p>
                </div>
            </div>

            <form method="POST" action="{{ route('contents.delete', $content['id'] ?? '') }}" id="delete-form">
                @csrf
                <input type="hidden" name="confirm_delete" value="1">
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-danger" id="confirm-btn">
                        🗑️ Eliminar Definitivamente
                    </button>
                    <a href="{{ route('contents.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('delete-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const confirmText = prompt('Para confirmar la eliminación, escribe "ELIMINAR" (en mayúsculas):');
        
        if (confirmText === 'ELIMINAR') {
            const confirmBtn = document.getElementById('confirm-btn');
            confirmBtn.textContent = 'Eliminando...';
            confirmBtn.disabled = true;
            this.submit();
        } else {
            alert('Eliminación cancelada. Debes escribir "ELIMINAR" para confirmar.');
        }
    });
</script>
@endpush