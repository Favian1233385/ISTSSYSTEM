<?php $__env->startSection('title', 'ISTS Sucúa - Instituto Superior Tecnológico Sucúa'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Main Content -->
    <main id="main-content" class="main-content">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-background" style="background-image: url('<?php echo e(asset('assets/images/hero.jpg')); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                <div class="hero-overlay">
                    <div class="container">
                        <div class="hero-content">
                            <h1 class="hero-title">Instituto Superior Tecnológico Sucúa</h1>
                            <p class="hero-subtitle">Fortaleciendo la Educación Superior de Tercer Nivel en Morona Santiago</p>
                            <div class="hero-actions">
                                <a href="<?php echo e(url('/academicos')); ?>" class="btn btn-primary">Explorar Carreras</a>
                                <a href="<?php echo e(url('/contacto')); ?>" class="btn btn-secondary">Solicitar Información</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>




        <!-- Misión y Visión Section (reemplaza Enfoque) -->
        <?php echo $__env->make('public.partials.home_mision_vision', ['content' => $misionVision ?? null], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Últimas actualizaciones multimedia -->
        <?php echo $__env->make('public.partials.updates', ['updates' => $updates ?? []], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Academic Programs Section - Profesional e Institucional -->
        <section class="careers-section" style="padding: 3.5rem 0; background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);">
            <div class="container">
                <div class="programs-header">
                    <h2>¡Tenemos una carrera para ti!</h2>
                    <p>Descubre nuestras ofertas académicas diseñadas para el futuro, con carreras tecnológicas de alto impacto y formación docente de excelencia.</p>
                </div>
                <div class="careers-grid">
                    <div class="career-card">
                        <div class="career-images">
                            <img class="career-image active" src="<?php echo e(asset('assets/images/carreras/software.jpg')); ?>" alt="Desarrollo de Software">
                        </div>
                        <div class="career-content">
                            <h3>Desarrollo de Software</h3>
                            <p>Formación en programación, ingeniería de software y desarrollo de aplicaciones modernas para la industria 4.0.</p>
                            <a href="<?php echo e(url('/academicos/desarrollo-software')); ?>" class="btn-career">Más información <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="career-card">
                        <div class="career-images">
                            <img class="career-image active" src="<?php echo e(asset('assets/images/carreras/contabilidad.jpg')); ?>" alt="Contabilidad y Asesoría Tributaria">
                        </div>
                        <div class="career-content">
                            <h3>Contabilidad y Asesoría Tributaria</h3>
                            <p>Especialización en contabilidad, asesoría fiscal y gestión financiera para empresas y emprendimientos.</p>
                            <a href="<?php echo e(url('/academicos/contabilidad')); ?>" class="btn-career">Más información <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="career-card">
                        <div class="career-images">
                            <img class="career-image active" src="<?php echo e(asset('assets/images/carreras/agroecologia.jpg')); ?>" alt="Agroecología">
                        </div>
                        <div class="career-content">
                            <h3>Agroecología</h3>
                            <p>Desarrollo sostenible, agricultura ecológica y gestión ambiental para el futuro del planeta.</p>
                            <a href="<?php echo e(url('/academicos/agroecologia')); ?>" class="btn-career">Más información <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="career-card">
                        <div class="career-images">
                            <img class="career-image active" src="<?php echo e(asset('assets/images/carreras/educacion-inicial.jpg')); ?>" alt="Educación Inicial">
                        </div>
                        <div class="career-content">
                            <h3>Educación Inicial</h3>
                            <p>Formación docente de excelencia para la educación inicial y el desarrollo integral de la niñez.</p>
                            <a href="<?php echo e(url('/academicos/educacion-inicial')); ?>" class="btn-career">Más información <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="programs-cta">
                    <a href="<?php echo e(url('/academicos')); ?>" class="btn-primary-large">Ver todas las carreras</a>
                </div>
            </div>
        </section>

        <!-- Recent Content Section -->
        <section class="focus-section">
            <div class="container">
                <div class="focus-header">
                    <h2>Contenido Reciente</h2>
                    <p>Explora nuestros artículos y publicaciones más recientes.</p>
                </div>

                <div class="focus-grid">
                    <?php if(isset($contents) && !empty($contents)): ?>
                        <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="focus-card">
                                <?php if(!empty($content["image_url"])): ?>
                                    <div class="focus-image">
                                        <img src="<?php echo e(asset(htmlspecialchars($content["image_url"]))); ?>" alt="<?php echo e(htmlspecialchars($content["title"])); ?>">
                                    </div>
                                <?php endif; ?>
                                <div class="focus-content">
                                    <h3><?php echo e(htmlspecialchars($content["title"])); ?></h3>
                                    <p><?php echo e(htmlspecialchars($content["description"])); ?></p>
                                    <div class="focus-actions">
                                        <a href="<?php echo e(url('/contenido/' . htmlspecialchars($content["slug"]))); ?>" class="btn btn-outline">Leer más</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <p>No hay contenido reciente disponible.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Mensaje del Rector -->
        <?php echo $__env->make('public.partials.rector', ['rector' => $rector ?? null], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Sección duplicada de carreras eliminada: ya existe una versión profesional más arriba -->

        <!-- News Section - Harvard Style -->
        <section class="news-section">
            <div class="container">
                <div class="section-header">
                    <h2>La Gaceta del ISTS</h2>
                    <p>Noticias oficiales del Instituto Superior Tecnológico Sucúa sobre ciencia, tecnología, vida del campus, temas universitarios y preocupaciones nacionales y globales más amplias.</p>
                </div>

                <div class="news-grid">
                    <div class="news-card featured">
                        <div class="news-image">
                            <img src="<?php echo e(asset('assets/images/noticia-principal.jpg')); ?>" alt="Noticia Principal">
                        </div>
                        <div class="news-content">
                            <span class="news-category">Tecnología</span>
                            <h3>Nuevas Tecnologías en el ISTS</h3>
                            <p>El Instituto Superior Tecnológico Sucúa implementa nuevas tecnologías para mejorar la experiencia educativa de nuestros estudiantes.</p>
                            <a href="<?php echo e(url('/noticias/tecnologia-ists')); ?>" class="read-more">Leer más →</a>
                        </div>
                    </div>

                    <div class="news-card">
                        <div class="news-image">
                            <img src="<?php echo e(asset('assets/images/noticia-2.jpg')); ?>" alt="Noticia 2">
                        </div>
                        <div class="news-content">
                            <span class="news-category">Académico</span>
                            <h3>Nuevas Carreras Disponibles</h3>
                            <p>Conoce las nuevas carreras que el ISTS ofrece para el próximo semestre.</p>
                            <a href="<?php echo e(url('/noticias/nuevas-carreras')); ?>" class="read-more">Leer más →</a>
                        </div>
                    </div>

                    <div class="news-card">
                        <div class="news-image">
                            <img src="<?php echo e(asset('assets/images/noticia-3.jpg')); ?>" alt="Noticia 3">
                        </div>
                        <div class="news-content">
                            <span class="news-category">Campus</span>
                            <h3>Mejoras en el Campus</h3>
                            <p>El ISTS continúa mejorando sus instalaciones para brindar una mejor experiencia educativa.</p>
                            <a href="<?php echo e(url('/noticias/mejoras-campus')); ?>" class="read-more">Leer más →</a>
                        </div>
                    </div>
                </div>

                <div class="news-actions">
                    <a href="<?php echo e(url('/noticias')); ?>" class="btn btn-primary">Ver todas las noticias</a>
                    <a href="<?php echo e(url('/noticias/suscribirse')); ?>" class="btn btn-outline">Suscribirse a la Gaceta Diaria</a>
                </div>
            </div>
        </section>

        <!-- Quick Links Section -->
        <?php echo $__env->make('public.partials.quick_links', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </main>

    <!-- Chatbot Widget -->
    <div id="chatbot-widget" class="chatbot-widget">
        <button id="chatbot-toggle" class="chatbot-toggle" aria-label="Abrir Chatbot">
        🤖
        </button>

        <div id="chatbot-window" class="chatbot-window" style="display: none;">
            <div class="chatbot-header">
                <h3>Asistente Virtual ISTS</h3>
                <button id="chatbot-close" aria-label="Cerrar Chatbot">✕</button>
            </div>

            <div id="chatbot-messages" class="chatbot-messages">
                <div class="bot-message">
                    <p>¡Hola! 👋 Soy el asistente virtual del ISTS. ¿En qué puedo ayudarte?</p>
                </div>
            </div>

            <form id="chatbot-form" class="chatbot-form">
                <input type="hidden" id="chat-session-id" value="">
                <?php echo csrf_field(); ?>
                <input type="text"
                       id="chatbot-input"
                       name="message"
                       placeholder="Escribe tu pregunta..."
                       maxlength="500"
                       required>
                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <!-- Scripts -->
    <script src="<?php echo e(asset('js/main.js')); ?>"></script>
    <script src="<?php echo e(asset('js/chatbot.js')); ?>"></script>
    <script src="<?php echo e(asset('js/harvard-interactions.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/public/home.blade.php ENDPATH**/ ?>