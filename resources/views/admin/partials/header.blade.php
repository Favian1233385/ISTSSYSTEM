<header class="admin-header">
    <div class="admin-header-content">
        @php $base = rtrim(request()->getBasePath(), '/'); @endphp
        <div class="admin-logo">
            <img src="{{ ($base !== '' ? $base : '') . '/assets/images/logoists.png' }}" alt="ISTS Logo" class="admin-logo-img">
            <h1>ISTS Admin</h1>
        </div>

        <nav class="admin-nav">
            <ul class="admin-nav-menu">
                <li><a href="{{ url('/admin/dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active':'' }}">📊 Dashboard</a></li>
                <li><a href="{{ url('/admin/contents') }}" class="{{ request()->is('admin/contents*') ? 'active':'' }}">📝 Contenidos</a></li>
                <li><a href="{{ url('/admin/news') }}" class="{{ request()->is('admin/news*') ? 'active':'' }}">📰 Noticias</a></li>
                <li><a href="{{ url('/admin/about') }}" class="{{ request()->is('admin/about*') ? 'active':'' }}">ℹ️ Acerca</a></li>
                <li><a href="{{ route('admin.autoridades.index') }}" class="{{ request()->is('admin/autoridades*') ? 'active':'' }}">👨‍💼 Autoridades</a></li>
                <li><a href="{{ url('/admin/users') }}" class="{{ request()->is('admin/users*') ? 'active':'' }}">👥 Usuarios</a></li>
                <li><a href="{{ url('/admin/settings') }}" class="{{ request()->is('admin/settings') ? 'active':'' }}">⚙️ Configuración</a></li>
            </ul>
        </nav>

        <div class="admin-user-menu">
            <div class="user-info">
                <span class="user-name">{{ optional(Auth::user())->email ?? 'Usuario' }}</span>
                <div class="user-dropdown">
                    <a href="{{ url('/admin/profile') }}">👤 Perfil</a>
                    <a href="{{ url('/auth/change-password') }}">🔒 Cambiar Contraseña</a>
                    <a href="{{ url('/logout') }}">🚪 Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </div>
</header>
