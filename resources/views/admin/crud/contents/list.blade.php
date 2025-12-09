<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Gestión de Contenidos - ISTS Admin' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/harvard-style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="admin-body">
    <!-- Header Administrativo -->
    <header class="admin-header">
        <div class="admin-header-content">
            <div class="admin-logo">
                <img src="{{ asset('public/assets/images/logo-ists.png') }}" alt="ISTS Logo" class="admin-logo-img">
                <h1>ISTS Admin</h1>
            </div>

            <nav class="admin-nav">
                <ul class="admin-nav-menu">
                    <li><a href="{{ url('admin/dashboard') }}">📊 Dashboard</a></li>
                    <li><a href="{{ url('contents/create') }}" class="active">📝 Contenidos</a></li>
                    <li><a href="{{ url('news/create') }}">📰 Noticias</a></li>
                    <li><a href="{{ url('users') }}">👥 Usuarios</a></li>
                    <li><a href="{{ url('settings') }}">⚙️ Configuración</a></li>
                </ul>
            </nav>

            <div class="admin-user-menu">
                <div class="user-info">
                    <span class="user-name">{{ session('user_email', 'Usuario') }}</span>
                    <div class="user-dropdown">
                        <a href="{{ url('admin/profile') }}">👤 Perfil</a>
                        <a href="{{ url('auth/change-password') }}">🔒 Cambiar Contraseña</a>
                        <a href="{{ url('auth/logout') }}">🚪 Cerrar Sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="admin-main">
        <div class="admin-container">
            <div class="admin-content">
                <div class="dashboard-header">
                    <h1>📝 Gestión de Contenidos</h1>
                    <p>Administra los contenidos del sitio.</p>
                    <a href="{{ route('admin.contents.create') }}" class="btn btn-primary">Crear Sección</a>
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

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Documentos</th>
                                <th>Sitios Externos</th>
                                <th>Estado</th>
                                <th>Creado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($is_hierarchical) && $is_hierarchical)
                                @foreach ($items as $parent)
                                    <tr>
                                        <td>{{ $parent["id"] }}</td>
                                        <td><strong>{{ $parent["title"] }}</strong></td>
                                        <td>
                                            @if(!empty($parent['file_url']))
                                                @php $files = json_decode($parent['file_url'], true); @endphp
                                                @if(is_array($files))
                                                    @foreach($files as $file)
                                                        <a href="{{ asset($file) }}" target="_blank">Ver Archivo</a><br>
                                                    @endforeach
                                                @elseif(filter_var($parent['file_url'], FILTER_VALIDATE_URL))
                                                    <a href="{{ $parent['file_url'] }}" target="_blank">Ver Archivo Externo</a>
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($parent['is_external']) && !empty($parent['url']))
                                                <a href="{{ $parent['url'] }}" target="_blank">{{ $parent['url'] }}</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td><span class="badge status-{{ $parent["status"] }}">{{ $parent["status"] }}</span></td>
                                        <td>{{ \Carbon\Carbon::parse($parent["created_at"])->format('d/m/Y') }}</td>
                                        <td class="actions">
                                            <a href="{{ route('admin.contents.edit', $parent['id']) }}" class="btn btn-sm btn-secondary">Editar</a>
                                            <form action="{{ route('admin.contents.destroy', $parent['id']) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este contenido?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                            </form>
                                            @if($parent['category'] !== 'tramites')
                                                <a href="{{ route('admin.contents.create', ['parent_id' => $parent['id']]) }}" class="btn btn-sm btn-success">Agregar Subreglamento</a>
                                            @endif
                                        </td>
                                    </tr>
                                @if($parent['category'] !== 'tramites' && !empty($parent['children']))
                                    @foreach($parent['children'] as $child)
                                        <tr style="background-color: #f9f9f9;">
                                            <td>{{ $child["id"] }}</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;└─ {{ $child["title"] }} <small>(Sub-reglamento)</small></td>
                                            <td>
                                                @if(!empty($child['file_url']))
                                                    @php $files = json_decode($child['file_url'], true); @endphp
                                                    @if(is_array($files))
                                                        @foreach($files as $file)
                                                            <a href="{{ asset($file) }}" target="_blank">Ver Archivo</a><br>
                                                        @endforeach
                                                    @elseif(filter_var($child['file_url'], FILTER_VALIDATE_URL))
                                                        <a href="{{ $child['file_url'] }}" target="_blank">Ver Archivo Externo</a>
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if(!empty($child['is_external']) && !empty($child['url']))
                                                    <a href="{{ $child['url'] }}" target="_blank">{{ $child['url'] }}</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td><span class="badge status-{{ $child["status"] }}">{{ $child["status"] }}</span></td>
                                            <td>{{ \Carbon\Carbon::parse($child["created_at"])->format('d/m/Y') }}</td>
                                            <td class="actions">
                                                <a href="{{ route('admin.contents.edit', $child['id']) }}" class="btn btn-sm btn-secondary">Editar</a>
                                                <form action="{{ route('admin.contents.destroy', $child['id']) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este contenido?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                @endforeach
                            @else
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $item["id"] }}</td>
                                        <td>{{ $item["title"] }}</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td><span class="badge status-{{ $item["status"] }}">{{ $item["status"] }}</span></td>
                                        <td>{{ \Carbon\Carbon::parse($item["created_at"])->format('d/m/Y') }}</td>
                                        <td class="actions">
                                            <a href="{{ route('admin.contents.edit', $item['id']) }}" class="btn btn-sm btn-secondary">Editar</a>
                                            <form action="{{ route('admin.contents.destroy', $item['id']) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este contenido?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                {{ $items->links() }}
            </div>
        </div>
    </main>

    <!-- Footer Administrativo -->
    <footer class="admin-footer">
        <div class="admin-footer-content">
            <p>&copy; {{ date('Y') }} Instituto Superior Tecnológico Sucúa - Panel Administrativo Todos los Derechos reservados F.C</p>
            <div class="admin-footer-links">
                <a href="{{ url('/') }}" target="_blank">🌐 Ver Sitio Web</a>
                <a href="{{ url('/admin/help') }}">❓ Ayuda</a>
                <a href="{{ url('/admin/logs') }}">📋 Logs del Sistema</a>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
