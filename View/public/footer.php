    <!-- Footer -->
    <footer class="footer">
        <div class="container">
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
                <p>&copy; <?= date('Y') ?> Instituto Superior Tecnológico Sudamericano. Todos los derechos reservados.</p>
                <nav class="footer-nav">
                    <a href="/privacidad">Privacidad</a>
                    <a href="/terminos">Términos</a>
                    <a href="/accesibilidad">Accesibilidad</a>
                </nav>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="back-to-top" class="back-to-top" aria-label="Volver arriba">
        ↑
    </button>

    <!-- Scripts -->
    <script src="<?= APP_URL ?>/public/js/main.js"></script>
    <script src="<?= APP_URL ?>/public/js/chatbot.js"></script>

    <style>
        /* Back to Top Button */
        .back-to-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 50px;
            height: 50px;
            background-color: var(--color-primary);
            color: var(--color-white);
            border: none;
            border-radius: 50%;
            font-size: 1.5rem;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .back-to-top.visible {
            opacity: 1;
            visibility: visible;
        }

        .back-to-top:hover {
            background-color: var(--color-secondary);
            transform: translateY(-2px);
        }

        /* Footer Enhancements */
        .footer {
            background-color: var(--color-dark);
            color: var(--color-white);
            padding: 3rem 0 1rem;
            margin-top: 4rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h4 {
            margin-bottom: 1rem;
            font-size: 1.2rem;
            color: var(--color-white);
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section li {
            margin-bottom: 0.5rem;
        }

        .footer-section a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-section a:hover {
            color: var(--color-white);
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-links a {
            font-size: 1.5rem;
            padding: 0.5rem;
            border-radius: 50%;
            background-color: rgba(255,255,255,0.1);
            transition: var(--transition);
        }

        .social-links a:hover {
            background-color: var(--color-primary);
            transform: translateY(-2px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-nav {
            display: flex;
            gap: 1.5rem;
        }

        .footer-nav a {
            color: rgba(255,255,255,0.6);
            font-size: 0.9rem;
        }

        address p {
            margin-bottom: 0.5rem;
            font-style: normal;
        }

        /* Responsive Footer */
        @media (max-width: 768px) {
            .footer-grid {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }

            .footer-nav {
                justify-content: center;
            }

            .back-to-top {
                bottom: 1rem;
                right: 1rem;
                width: 45px;
                height: 45px;
                font-size: 1.2rem;
            }
        }
    </style>

    <script>
        // Back to top functionality
        document.addEventListener('DOMContentLoaded', function() {
            const backToTopBtn = document.getElementById('back-to-top');

            if (backToTopBtn) {
                // Show/hide button based on scroll position
                window.addEventListener('scroll', function() {
                    if (window.pageYOffset > 300) {
                        backToTopBtn.classList.add('visible');
                    } else {
                        backToTopBtn.classList.remove('visible');
                    }
                });

                // Smooth scroll to top
                backToTopBtn.addEventListener('click', function() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
        });
    </script>
</body>
</html>
