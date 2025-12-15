<footer class="footer">
    <!-- Contenedor eliminado para ancho completo -->
        <div class="footer-grid">
            <div class="footer-section">
                <h4>Instituto Superior Tecnológico Sucúa</h4>
                <p>Formando profesionales de excelencia desde 1995</p>
                <div class="footer-logo" style="margin-top: 1rem; margin-bottom: 1rem; text-align: left;">
                    <a href="{{ url('/') }}" aria-label="Inicio ISTS">
                        <img src="{{ asset('assets/images/logoists.png') }}" alt="Logo ISTS" style="height: 56px; vertical-align: middle;">
                    </a>
                </div>

            </div>

            <div class="footer-section">
                <h4>Enlaces Rápidos</h4>
                <ul>
                    <li><a href="{{ url('/eventos') }}">Eventos</a></li>
                    <li><a href="{{ url('/carreras') }}">Carreras</a></li>
                    <li><a href="{{ url('/actualizaciones') }}">Admisión</a></li>
                    <li><a href="https://biblioteca.istsucua.edu.ec" target="_blank" rel="noopener">Biblioteca</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h4>Recursos</h4>
                <ul>
                    <li><a href="/calendario">Calendario Académico</a></li>
                    @include('public.partials.footer_calendar_card')
                    <li><a href="/reglamentos">Reglamentos</a></li>
                    <li><a href="/becas">Becas</a></li>
                    <li><a href="/empleos">Bolsa de Empleo</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h4>Contacto</h4>
                <address>
                    <p>📍 Efrén Zúñiga - Luis Sangurima, Sucúa - Ecuador</p>
                    <p>📞 (07) 274-0421</p>
                    <p>📧 secretaria@istsucua.edu.ec</p>
                    <p>🕐 Lun-Vie: 14:00 PM - 22:00 PM</p>
                </address>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Instituto Superior Tecnológico Sucúa. Todos los derechos reservados.</p>
            <nav class="footer-nav">
                <a href="/privacidad">Privacidad</a>
                <a href="/terminos">Términos</a>
                <a href="/accesibilidad">Accesibilidad</a>
            </nav>
        </div>
    <!-- Fin del contenedor eliminado -->

    <button id="back-to-top" class="back-to-top" aria-label="Volver arriba">↑</button>

    <script src="{{ asset(ltrim(($base ?? '') . '/js/main.js', '/')) }}"></script>
</footer>
