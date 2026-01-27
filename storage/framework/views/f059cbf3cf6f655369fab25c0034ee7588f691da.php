

<?php $__env->startSection('content'); ?>
    <main class="admin-main">
        <div class="admin-container">
            <?php if(request()->query('success')): ?>
                <div class="alert alert-success">
                    <span>✅</span>
                    <?php echo e(request()->query('success')); ?>

                </div>
            <?php endif; ?>

            <?php if(request()->query('error')): ?>
                <div class="alert alert-error">
                    <span>❌</span>
                    <?php echo e(request()->query('error')); ?>

                </div>
            <?php endif; ?>

            <!-- Dashboard Content -->
            <div class="dashboard-header">
                <h1>📊 Panel Administrativo</h1>
                <p>Bienvenido al panel de administración del ISTS</p>
            </div>

    <!-- Estadísticas (recuperadas de la versión previa) -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">📝</div>
            <div class="stat-content">
                <h3><?php echo e($totalContents ?? 0); ?></h3>
                <p>Contenidos Totales</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">📰</div>
            <div class="stat-content">
                <h3><?php echo e($totalNews ?? 0); ?></h3>
                <p>Noticias Totales</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-content">
                    <h3><?php echo e($totalUsers ?? 0); ?></h3>
                <p>Usuarios Registrados</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">👁️</div>
            <div class="stat-content">
                <h3><?php echo e($totalViews ?? 0); ?></h3>
                <p>Vistas Totales</p>
            </div>
        </div>
    </div>

    <!-- Gestión de Contenido - Cajas Cuadradas -->
        <div class="quick-actions" id="gestion-contenidos">
            <h2>➕ GESTIÓN DE CONTENIDO</h2>
            <div class="actions-grid">
                <a href="<?php echo e(route('admin.contents.index')); ?>" class="action-card">
                    <div class="action-icon">📝</div>
                    <h3>Todos los Contenidos</h3>
                    <p><?php echo e($totalContents); ?> artículos totales</p>
                </a>

                <a href="<?php echo e(route('admin.qas.index')); ?>" class="action-card">
                    <div class="action-icon">💬</div>
                    <h3>Chatbot Q&A</h3>
                    <p><?php echo e($qasCount); ?> preguntas y respuestas</p>
                </a>

                <a href="<?php echo e(route('admin.chatbot.index')); ?>" class="action-card">
                    <div class="action-icon">🤖</div>
                    <h3>Gestión de Chatbot</h3>
                    <p>Administrar mensajes del asistente virtual</p>
                </a>

                <a href="<?php echo e(route('admin.updates.index')); ?>" class="action-card">
                    <div class="action-icon">📢</div>
                    <h3>Actualizaciones</h3>
                    <p><?php echo e($updatesActiveCount); ?> novedades activas</p>
                </a>

                <a href="<?php echo e(route('admin.news.index')); ?>" class="action-card">
                    <div class="action-icon">📰</div>
                    <h3>Noticias</h3>
                    <p>Gestionar La Gaceta del ISTS</p>
                </a>


                <a href="<?php echo e(route('admin.events.index')); ?>" class="action-card">
                    <div class="action-icon">📅</div>
                    <h3>Eventos</h3>
                    <p>Gestionar eventos institucionales</p>
                </a>

                <a href="<?php echo e(route('admin.academic-calendar.index')); ?>" class="action-card">
                    <div class="action-icon">📆</div>
                    <h3>Calendario Académico</h3>
                    <p>Gestionar fechas y periodos académicos</p>
                </a>

                

                <a href="<?php echo e(route('admin.visit-sections.index')); ?>" class="action-card">
                    <div class="action-icon">🏢</div>
                    <h3>Secciones Visitar</h3>
                    <p>Gestionar áreas institucionales</p>
                </a>

                <a href="<?php echo e(route('admin.transparency.index')); ?>" class="action-card">
                    <div class="action-icon">📄</div>
                    <h3>Transparencia</h3>
                    <p>Gestionar documentos de transparencia institucional</p>
                </a>

                <a href="<?php echo e(route('admin.tramites.index')); ?>" class="action-card">
                    <div class="action-icon">📂</div>
                    <h3>Documentos</h3>
                    <p><?php echo e($tramitesCount ?? 0); ?> documentos</p>
                </a>

                


                <a href="<?php echo e(route('admin.social_links.index')); ?>" class="action-card" style="background: linear-gradient(135deg, #e0f7fa 0%, #b2ebf2 100%); border: 2px solid #00bcd4;">
                    <div class="action-icon">🔗</div>
                    <h3>Redes Sociales</h3>
                    <p>Gestionar enlaces y WhatsApp flotante</p>
                </a>

                <a href="<?php echo e(route('admin.settings.index')); ?>" class="action-card" style="background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%); border: 2px solid #ff9800;">
                    <div class="action-icon">⚙️</div>
                    <h3>Configuración General</h3>
                    <p>WhatsApp, email, redes sociales</p>
                </a>

                <a href="<?php echo e(route('about.index')); ?>" class="action-card">
                    <div class="action-icon">ℹ️</div>
                    <h3>Acerca</h3>
                    <p>Gestionar secciones de Acerca, autoridades, rector, etc.</p>
                </a>

                <a href="<?php echo e(route('admin.hero-slides.index')); ?>" class="action-card" style="background: linear-gradient(135deg, #e0f7fa 0%, #80deea 100%); border: 2px solid #00bcd4;">
                    <div class="action-icon">🖼️</div>
                    <h3>Gestionar Carrusel</h3>
                    <p>Administra las imágenes del carrusel principal</p>
                </a>

                <a href="<?php echo e(route('admin.popups.index')); ?>" class="action-card">
                    <div class="action-icon">🎯</div>
                    <h3>PopUp</h3>
                    <p>Gestionar banner destacado del sitio</p>
                </a>
            </div>
        </div>

    <!-- Sección Académicos -->
    <div class="quick-actions" id="seccion-academicos">
        <h2>🎓 SECCIÓN ACADÉMICOS</h2>
        <div class="actions-grid">
            <a href="<?php echo e(route('admin.careers.index')); ?>" class="action-card">
                <div class="action-icon">🎓</div>
                <h3>Programas de Grado</h3>
                <p><?php echo e($careers->count()); ?> carreras tecnológicas</p>
            </a>
            <a href="<?php echo e(route('admin.academic_modalities.index')); ?>" class="action-card">
                <div class="action-icon">📚</div>
                <h3>Educación Continua</h3>
                <p>Gestionar modalidades y programas</p>
            </a>
            <a href="<?php echo e(route('admin.teachers.index')); ?>" class="action-card">
                <div class="action-icon">👨‍🏫</div>
                <h3>Docentes</h3>
                <p><?php echo e($teachersCount ?? 0); ?> profesores registrados</p>
            </a>
        </div>
    </div>

    <!-- Sección Servicios -->
    <div class="quick-actions" id="seccion-campus">
        <h2>🏛️ SECCIÓN SERVICIOS</h2>
        <div class="actions-grid">
            <a href="<?php echo e(route('admin.campus-items.index')); ?>" class="action-card">
                <div class="action-icon">🏛️</div>
                <h3>Servicios</h3>
                <p><?php echo e($campusItems->count()); ?> servicios disponibles</p>
            </a>
        </div>
    </div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ists\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>