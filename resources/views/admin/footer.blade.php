<footer class="admin-footer">
	<div class="footer-inner">
		<p>© {{ date('Y') }} Instituto Superior Tecnológico Sucúa - Panel Administrativo</p>
		<div class="links">
			<a href="{{ url('/') }}">🌐 Ver Sitio Web</a>
			<a href="{{ route('admin.help') }}">❓ Ayuda</a>
			<a href="{{ route('admin.logs') }}">📋 Logs del Sistema</a>
		</div>
	</div>
</footer>

@push('styles')
<style>
.admin-footer { position: relative; bottom: auto; left: auto; right: auto; width: 100%; background:#0d2130; color:#fff; padding:1rem 2rem; }
</style>
@endpush
