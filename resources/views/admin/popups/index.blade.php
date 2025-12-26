@extends('admin.layout')

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3" style="background:none; box-shadow:none; border-radius:0; padding:0;">
        <h1 class="fw-bold mb-0" style="font-size:2.1rem; color:#222; letter-spacing:0.5px;">PopUps Destacados</h1>
        <a href="{{ route('admin.popups.create') }}" class="btn" style="background: linear-gradient(90deg,#009e60,#1e3a8a 90%); color:#fff; font-weight:600; border-radius:8px; padding:0.6rem 1.6rem; font-size:1.08rem; box-shadow:0 2px 8px rgba(30,58,138,0.10);">+ Nuevo PopUp</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="table-responsive">
    <table class="table" style="border-radius:14px; overflow:hidden; background:#fff; box-shadow:0 2px 12px rgba(44,62,80,0.07);">
        <thead style="background:#f3f3f3;">
            <tr style="text-align:center;">
                <th style="padding:12px 8px;">Imagen</th>
                <th style="padding:12px 8px;">Mensaje</th>
                <th style="padding:12px 8px;">Enlace</th>
                <th style="padding:12px 8px;">Estado</th>
                <th style="padding:12px 8px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($popups as $popup)
            <tr style="text-align:center; vertical-align:middle;">
                <td style="padding:10px;">
                    @if($popup->image_path)
                        <img src="{{ asset('storage/' . $popup->image_path) }}" alt="Banner" style="max-width:110px; border-radius:10px; box-shadow:0 2px 8px rgba(0,158,96,0.10); margin:0 auto; display:block;">
                    @else
                        <span style="color:#bbb;">Sin imagen</span>
                    @endif
                </td>
                <td style="max-width:220px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $popup->message }}</td>
                <td>
                    @if($popup->link)
                        <a href="{{ $popup->link }}" target="_blank" style="color:#1976d2; font-weight:500;">Ver enlace</a>
                    @else
                        <span style="color:#bbb;">-</span>
                    @endif
                </td>
                <td>
                    @if($popup->is_active)
                        <span style="background:#10b981; color:#fff; border-radius:8px; padding:4px 16px; font-weight:600;">Activo</span>
                    @else
                        <span style="background:#bbb; color:#fff; border-radius:8px; padding:4px 16px; font-weight:600;">Inactivo</span>
                    @endif
                </td>
                <td style="display:flex; gap:10px; justify-content:center; align-items:center; min-width:180px;">
                    <a href="{{ route('admin.popups.edit', $popup) }}" class="btn popup-action-btn" style="background:#10b981;">Editar</a>
                    <form action="{{ route('admin.popups.destroy', $popup) }}" method="POST" style="display:inline-block; margin:0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn popup-action-btn" style="background:#ef4444;" onclick="return confirm('¿Eliminar este PopUp?')">Eliminar</button>
                    </form>
                </td>
            </tbody>
            </table>
            </div>
            <style>
                .popup-action-btn {
                    color: #fff !important;
                    font-weight: 600;
                    border-radius: 8px;
                    min-width: 90px;
                    min-height: 42px;
                    max-height: 42px;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 1rem;
                    box-shadow: 0 1px 4px rgba(44,62,80,0.07);
                    transition: background 0.2s;
                }
                .popup-action-btn:hover {
                    filter: brightness(0.95);
                }
            </style>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
@endsection
