<footer class="footer">
    <!-- Contenedor eliminado para ancho completo -->
        <div class="footer-grid">
            <div class="footer-section">
                <h4>Instituto Superior Tecnológico Sudamericano</h4>
                <p>Formando profesionales de excelencia desde 1995</p>
                <div class="social-links">
                    <a href="#" aria-label="Facebook" target="_blank" rel="noopener">📘</a>
                    <a href="#" aria-label="Twitter" target="_blank" rel="noopener">🐦</a>
                    <a href="#" aria-label="Instagram" target="_blank" rel="noopener">📷</a>
                    <a href="#" aria-label="LinkedIn" target="_blank" rel="noopener">💼</a>
                </div>
            </div>

            <div class="footer-section">
                <h4>Enlaces Rápidos</h4>
                <ul>
                    <li><a href="/nosotros">Sobre Nosotros</a></li>
                    <li><a href="/carreras">Carreras</a></li>
                    <li><a href="/admision">Admisión</a></li>
                    <li><a href="/biblioteca">Biblioteca</a></li>
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
                    <p>📍 Av. Principal 123, Quito - Ecuador</p>
                    <p>📞 (02) 2345-678</p>
                    <p>📧 info@ists.edu.ec</p>
                    <p>🕐 Lun-Vie: 8:00 AM - 6:00 PM</p>
                </address>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Instituto Superior Tecnológico Sudamericano. Todos los derechos reservados.</p>
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
