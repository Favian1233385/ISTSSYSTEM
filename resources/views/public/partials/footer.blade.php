<footer class="footer">
    <!-- Contenedor eliminado para ancho completo -->
        <div class="footer-grid">
            <div class="footer-section">
                <h4>Instituto Superior Tecnológico Sucúa</h4>
                <p>Formando profesionales de excelencia desde 1995</p>
                <div class="social-links">
                    <a href="https://facebook.com/istsucua" aria-label="Facebook" target="_blank" rel="noopener">
                        <img src="{{ asset('assets/images/footer/facebook.png') }}" alt="Facebook" width="32" height="32">
                    </a>
                    <a href="https://x.com/istsucua" aria-label="X" target="_blank" rel="noopener">
                        <img src="{{ asset('assets/images/footer/x.png') }}" alt="X (Twitter)" width="32" height="32">
                    </a>
                    <a href="https://instagram.com/istsucua" aria-label="Instagram" target="_blank" rel="noopener">
                        <img src="{{ asset('assets/images/footer/instagram.png') }}" alt="Instagram" width="32" height="32">
                    </a>
                    <a href="https://tiktok.com/@ist_sucua" aria-label="TikTok" target="_blank" rel="noopener">
                        <img src="{{ asset('assets/images/footer/tiktok.png') }}" alt="TikTok" width="32" height="32">
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
