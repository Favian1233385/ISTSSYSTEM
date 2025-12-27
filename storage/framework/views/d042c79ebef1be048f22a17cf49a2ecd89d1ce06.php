<footer class="footer">
    <!-- Contenedor eliminado para ancho completo -->
        <div class="footer-grid">
            <div class="footer-section">
                <h4>Instituto Superior Tecnológico Sucúa</h4>
                <p>Formando profesionales de excelencia desde 1995</p>
                <div class="footer-logo" style="margin-top: 1rem; margin-bottom: 1rem; text-align: left;">
                    <a href="<?php echo e(url('/')); ?>" aria-label="Inicio ISTS">
                        <img src="<?php echo e(asset('assets/images/logoists.png')); ?>" alt="Logo ISTS" style="height: 56px; vertical-align: middle;">
                    </a>
                </div>

            </div>

            <div class="footer-section">
                <h4>Enlaces Rápidos</h4>
                <ul>
                    <li><a href="<?php echo e(url('/eventos')); ?>">Eventos</a></li>
                    <li><a href="<?php echo e(url('/carreras')); ?>">Carreras</a></li>
                    <li><a href="<?php echo e(url('/actualizaciones')); ?>">Admisión</a></li>
                    <li><a href="https://biblioteca.istsucua.edu.ec" target="_blank" rel="noopener">Biblioteca</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h4>Recursos</h4>
                <ul>
                    <li><a href="/calendario">Calendario Académico</a></li>
                    <?php echo $__env->make('public.partials.footer_calendar_card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <li><a href="/transparency/reglamentos">Reglamentos</a></li>
                   
                   
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
            <p>&copy; <?php echo e(date('Y')); ?> Instituto Superior Tecnológico Sucúa. Todos los derechos reservados.</p>
            <nav class="footer-nav">
                <p>&copy; <?php echo e(date('Y')); ?> Desarrollado por: Favian Cumbanama.</p>
               
            </nav>
        </div>
    <!-- Fin del contenedor eliminado -->

    <button id="back-to-top" class="back-to-top" aria-label="Volver arriba">↑</button>

    <script src="<?php echo e(asset(ltrim(($base ?? '') . '/js/main.js', '/'))); ?>"></script>
</footer>
<?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/public/partials/footer.blade.php ENDPATH**/ ?>