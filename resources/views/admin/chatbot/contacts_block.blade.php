@push('scripts')
<script src="{{ asset('resources/js/admin_chatbot_contacts.js') }}"></script>
@endpush
{{-- resources/views/admin/chatbot/contacts_block.blade.php --}}
<div class="card">
    <div class="card-body">
        <h2 class="mb-4" style="display:flex;align-items:center;gap:8px;font-size:1.5rem;">
            <span style="font-size:1.7rem;">📇</span> Contactos del Chatbot
        </h2>
        <div style="margin:1.2rem 0 2.2rem 0;">
            <!-- Fila de filtros -->
            <form method="GET" action="{{ route('admin.chatbot.contacts') }}" class="d-flex flex-row flex-wrap align-items-end gap-3" style="margin-bottom:0;">
                <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o teléfono" value="{{ request('search') }}" style="max-width:210px; min-width:180px; height:42px; padding:0.375rem 0.75rem;">
                <select name="carrera" class="form-select" style="max-width:180px; min-width:150px; height:42px; padding:0.375rem 0.75rem;">
                    <option value="">-- Todas las carreras --</option>
                    @foreach(\App\Models\ChatbotContact::select('carrera')->distinct()->whereNotNull('carrera')->where('carrera', '!=', '')->orderBy('carrera')->get() as $c)
                        <option value="{{ $c->carrera }}" @if(request('carrera') == $c->carrera) selected @endif>{{ $c->carrera }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary fw-semibold" style="height:42px; padding:0.375rem 1.25rem; min-width:130px;">Filtrar</button>
                <button type="button" class="btn btn-secondary fw-semibold" style="height:42px; padding:0.375rem 1.25rem; min-width:130px;" onclick="this.form.reset(); window.location.href=window.location.pathname;">Limpiar</button>
                <a href="{{ route('admin.chatbot.contacts.export') }}" class="btn fw-semibold excel-btn" style="height:42px; padding:0.375rem 1.25rem; min-width:220px; max-width:220px; display:inline-flex; align-items:center; justify-content:center;">Descargar Excel</a>
                                        <style>
                                        .excel-btn {
                                            background: linear-gradient(90deg, #21A366 0%, #43e97b 100%) !important;
                                            color: #fff !important;
                                            border: none;
                                            box-shadow: 0 2px 8px 0 rgba(33,163,102,0.10);
                                            border-radius: 0.5rem;
                                            font-weight: 600;
                                            font-size: 1rem;
                                            transition: box-shadow 0.2s, transform 0.2s, background 0.2s;
                                        }
                                        .excel-btn:hover, .excel-btn:focus {
                                            background: linear-gradient(90deg, #43e97b 0%, #21A366 100%) !important;
                                            color: #fff !important;
                                            box-shadow: 0 4px 16px 0 rgba(33,163,102,0.18);
                                            transform: translateY(-2px) scale(1.03);
                                            text-decoration: none;
                                        }
                                        </style>
                            <style>
                            .excel-btn {
                                background: linear-gradient(90deg, #21A366 0%, #43e97b 100%) !important;
                                color: #fff !important;
                                border: none;
                                box-shadow: 0 2px 8px 0 rgba(33,163,102,0.10);
                                border-radius: 0.5rem;
                                font-weight: 600;
                                font-size: 1rem;
                                transition: box-shadow 0.2s, transform 0.2s, background 0.2s;
                            }
                            .excel-btn:hover, .excel-btn:focus {
                                background: linear-gradient(90deg, #43e97b 0%, #21A366 100%) !important;
                                color: #fff !important;
                                box-shadow: 0 4px 16px 0 rgba(33,163,102,0.18);
                                transform: translateY(-2px) scale(1.03);
                                text-decoration: none;
                            }
                            </style>
                <button type="button" class="btn btn-danger fw-semibold" style="height:42px; padding:0.375rem 1.25rem; min-width:170px;" onclick="if(confirm('¿Estás seguro de eliminar todos los contactos? Esta acción no se puede deshacer.')){ document.getElementById('delete-all-contacts-form').submit(); }">Eliminar todos los contactos</button>
            </form>
            <style>
            .excel-btn {
                background: linear-gradient(90deg, #21A366 0%, #43e97b 100%);
                color: #fff !important;
                border: none;
                box-shadow: 0 2px 8px 0 rgba(33,163,102,0.15);
                border-radius: 0.5rem;
                transition: box-shadow 0.2s, transform 0.2s, background 0.2s;
                font-weight: 600;
                font-size: 1.1rem;
                padding: 0.375rem 1.25rem;
            }
            .excel-btn:hover, .excel-btn:focus {
                background: linear-gradient(90deg, #43e97b 0%, #21A366 100%);
                color: #fff !important;
                box-shadow: 0 4px 16px 0 rgba(33,163,102,0.25);
                transform: translateY(-2px) scale(1.03);
                text-decoration: none;
            }
            </style>
            <form id="delete-all-contacts-form" action="{{ route('admin.chatbot.contacts.destroyAll') }}" method="POST" style="display:none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
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
    </div>
</div>
