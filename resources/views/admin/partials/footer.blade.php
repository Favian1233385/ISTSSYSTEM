<footer class="admin-footer">
    <div class="footer-inner">
        <p>&copy; {{ date('Y') }} Instituto Superior Tecnológico Sucúa - Panel Administrativo</p>
        <div class="links">
            <a href="{{ url('/') }}">🌐 Ver Sitio Web</a>
            <a href="{{ url('/admin/help') }}">❓ Ayuda</a>
            <a href="{{ url('/admin/logs') }}">📋 Logs del Sistema</a>
        </div>
    </div>
</footer>

<style>
.admin-footer {
    position: relative;
    bottom: auto;
    left: auto;
    right: auto;
    width: 100%;
    background: #0d2130;
    color: #fff;
    padding: 1rem 2rem;
}
</style>
