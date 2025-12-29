{{-- resources/views/admin/chatbot/contacts_table.blade.php --}}
<div class="table-responsive" style="margin-top:1.5rem;">
    <table class="table table-bordered table-hover align-middle" style="background:#fff; border-radius:12px; overflow:hidden;">
        <thead class="table-light">
            <tr style="background:#f3f6fd; color:#2563eb;">
                <th style="width:60px;">#</th>
                <th style="min-width:180px;">Nombre</th>
                <th style="min-width:150px;">Teléfono</th>
                <th style="min-width:180px;">Carrera</th>
                <th style="min-width:180px;">Fecha de Registro</th>
            </tr>
        </thead>
        <tbody>
            @forelse($contacts as $contact)
                <tr>
                    <td style="text-align:center;font-weight:600;">{{ $contact->id }}</td>
                    <td style="text-transform:capitalize;">👤 {{ ucwords(strtolower($contact->nombre)) }}</td>
                    <td><span class="badge bg-success" style="font-size:1rem;letter-spacing:1px;">{{ $contact->telefono }}</span></td>
                    <td>{{ $contact->carrera }}</td>
                    <td><span style="color:#1976d2;font-weight:500;">{{ $contact->created_at->format('d/m/Y H:i') }}</span></td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay contactos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3">
    {{ $contacts->links() }}
</div>
