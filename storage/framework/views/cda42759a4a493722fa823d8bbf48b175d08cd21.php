<?php $__env->startSection('title', 'ISTS Sucúa - Instituto Superior Tecnológico Sucúa'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Main Content -->
    <main id="main-content" class="main-content p-0 m-0">
        <!-- Hero Section -->
        <section class="hero-section p-0 m-0" style="height:100vh; min-height:100vh; overflow:hidden;">
            <?php if(isset($heroSlides) && $heroSlides->count() > 0): ?>
                <div id="heroCarousel" class="carousel slide h-100" data-bs-ride="carousel" data-bs-interval="5000">
                    <!-- Indicadores -->
                    <div class="carousel-indicators">
                        <?php $__currentLoopData = $heroSlides->where('is_active', true)->values(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?php echo e($index); ?>"
                                class="<?php echo e($index === 0 ? 'active' : ''); ?>"
                                aria-current="<?php echo e($index === 0 ? 'true' : 'false'); ?>" aria-label="Slide <?php echo e($index + 1); ?>">
                            </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Slides -->
                    <div class="carousel-inner h-100">
                        <?php $__currentLoopData = $heroSlides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($slide->image_path): ?>
                            <div class="carousel-item <?php echo e($index === 0 ? 'active' : ''); ?> h-100">
                                <img src="<?php echo e(asset('uploads/images/' . $slide->image_path)); ?>"
                                    class="d-block w-100 h-100 object-fit-cover" alt="<?php echo e($slide->title); ?>"
                                    style="object-fit:cover;"
                                    onerror="this.src='<?php echo e(asset('uploads/images/placeholder.jpg')); ?>'">

                                <div
                                    class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100">
                                    <div class="p-4 rounded-4"
                                        style="background:rgba(30,30,30,0.55); backdrop-filter:blur(8px); box-shadow:0 4px 32px rgba(0,0,0,0.15); max-width:700px; width:100%;">
                                        <h1 class="fw-bold text-white"
                                            style="font-size:3rem; text-shadow:0 2px 8px rgba(0,0,0,0.4);">
                                            <?php echo e($slide->title); ?>

                                        </h1>
                                        <p class="lead text-white mb-4"
                                            style="font-size:1.5rem; text-shadow:0 1px 6px rgba(0,0,0,0.3);">
                                            <?php echo e($slide->subtitle); ?>

                                        </p>
                                        <div class="d-flex justify-content-center gap-3">
                                            <?php if($slide->link): ?>
                                                <a href="<?php echo e($slide->link); ?>" class="btn btn-warning btn-lg fw-bold"
                                                    style="box-shadow:0 2px 8px rgba(0,0,0,0.2);">
                                                    EXPLORAR CARRERAS
                                                </a>
                                            <?php endif; ?>
                                            <a href="#" class="btn btn-outline-light btn-lg fw-bold"
                                                style="box-shadow:0 2px 8px rgba(0,0,0,0.2);">
                                                SOLICITAR INFORMACIÓN
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Controles -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            <?php else: ?>
                <!-- Fallback si no hay slides -->
                <div class="d-flex justify-content-center align-items-center h-100 bg-dark text-white">
                    <div class="text-center">
                        <h1>Bienvenido al ISTS Sucúa</h1>
                        <p class="lead">No hay slides disponibles en este momento</p>
                    </div>
                </div>
            <?php endif; ?>
        </section>

        <!-- Script adicional para asegurar funcionamiento -->
        <?php $__env->startPush('scripts'); ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const carousel = document.querySelector('#heroCarousel');
                    if (carousel) {
                        // Inicializar el carrusel manualmente
                        const bsCarousel = new bootstrap.Carousel(carousel, {
                            interval: 5000,
                            wrap: true,
                            keyboard: true,
                            pause: 'hover'
                        });

                        console.log('Carrusel inicializado correctamente');
                    }
                });
            </script>
        <?php $__env->stopPush(); ?>




        <!-- Misión y Visión Section (reemplaza Enfoque) -->
        <?php echo $__env->make('public.partials.home_mision_vision', ['content' => $misionVision ?? null], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Últimas actualizaciones multimedia -->
        <?php echo $__env->make('public.partials.updates', ['updates' => $updates ?? []], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Academic Programs Section - Profesional e Institucional -->
        <section class="careers-section"
            style="padding: 3.5rem 0; background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);">
            <div class="container">
                <div class="programs-header">
                    <h2>¡Tenemos una carrera para ti!</h2>
                    <p>Descubre nuestras ofertas académicas diseñadas para el futuro, con carreras tecnológicas de alto
                        impacto y formación docente de excelencia.</p>
                </div>
                <div class="careers-grid">
                    <div class="career-card">
                        <div class="career-images">
                            <img class="career-image active"
                                src="<?php echo e(asset('uploads/images/69389bfbe28ab-software.jpeg')); ?>"
                                alt="Desarrollo de Software">
                        </div>
                        <div class="career-content">
                            <h3>Desarrollo de Software</h3>
                            <p>Formación en programación, ingeniería de software y desarrollo de aplicaciones modernas para
                                la industria 4.0.</p>
                            <a href="<?php echo e(url('/academicos/desarrollo-software')); ?>" class="btn-career">Más información <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="career-card">
                        <div class="career-images">
                            <img class="career-image active" src="<?php echo e(asset('uploads/images/690b6155ab769-conta.jpg')); ?>"
                                alt="Contabilidad y Asesoría Tributaria">
                        </div>
                        <div class="career-content">
                            <h3>Contabilidad y Asesoría Tributaria</h3>
                            <p>Especialización en contabilidad, asesoría fiscal y gestión financiera para empresas y
                                emprendimientos.</p>
                            <a href="<?php echo e(url('/academicos/contabilidad')); ?>" class="btn-career">Más información <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="career-card">
                        <div class="career-images">
                            <img class="career-image active" src="<?php echo e(asset('uploads/images/690b625993c58-agro.jpeg')); ?>"
                                alt="Agroecología">
                        </div>
                        <div class="career-content">
                            <h3>Agroecología</h3>
                            <p>Desarrollo sostenible, agricultura ecológica y gestión ambiental para el futuro del planeta.
                            </p>
                            <a href="<?php echo e(url('/academicos/agroecologia')); ?>" class="btn-career">Más información <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="career-card">
                        <div class="career-images">
                            <img class="career-image active"
                                src="<?php echo e(asset('uploads/images/690b6389a6930-educacion.jpg')); ?>" alt="Educación Inicial">
                        </div>
                        <div class="career-content">
                            <h3>Educación Inicial</h3>
                            <p>Formación docente de excelencia para la educación inicial y el desarrollo integral de la
                                niñez.</p>
                            <a href="<?php echo e(url('/academicos/educacion-inicial')); ?>" class="btn-career">Más información <i
                                    class="bi bi-arrow-right"></i></a>
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
                                <?php if(!empty($content['image_url'])): ?>
                                    <div class="focus-image">
                                        <img src="<?php echo e(asset(htmlspecialchars($content['image_url']))); ?>"
                                            alt="<?php echo e(htmlspecialchars($content['title'])); ?>">
                                    </div>
                                <?php endif; ?>
                                <div class="focus-content">
                                    <h3><?php echo e(htmlspecialchars($content['title'])); ?></h3>
                                    <p><?php echo e(htmlspecialchars($content['description'])); ?></p>
                                    <div class="focus-actions">
                                        <a href="<?php echo e(url('/contenido/' . htmlspecialchars($content['slug']))); ?>"
                                            class="btn btn-outline">Leer más</a>
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
                    <p>Noticias oficiales del Instituto Superior Tecnológico Sucúa sobre ciencia, tecnología, vida del
                        campus, temas universitarios y preocupaciones nacionales y globales más amplias.</p>
                </div>

                <div class="news-grid">
                    <div class="news-card featured">
                        <div class="news-image">
                            <img src="<?php echo e(asset('uploads/images/69388a0728100-RENDICION DE CUENTAS 20242.jpg')); ?>"
                                alt="Noticia Principal">
                        </div>
                        <div class="news-content">
                            <span class="news-category">Tecnología</span>
                            <h3>Nuevas Tecnologías en el ISTS</h3>
                            <p>El Instituto Superior Tecnológico Sucúa implementa nuevas tecnologías para mejorar la
                                experiencia educativa de nuestros estudiantes.</p>
                            <a href="<?php echo e(url('/noticias/tecnologia-ists')); ?>" class="read-more">Leer más →</a>
                        </div>
                    </div>

                    <div class="news-card">
                        <div class="news-image">
                            <img src="<?php echo e(asset('uploads/images/69388a38bb063-foto.jpeg')); ?>" alt="Noticia 2">
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
                            <img src="<?php echo e(asset('uploads/images/69388a533e4a0-luis.jpg')); ?>" alt="Noticia 3">
                        </div>
                        <div class="news-content">
                            <span class="news-category">Campus</span>
                            <h3>Mejoras en el Campus</h3>
                            <p>El ISTS continúa mejorando sus instalaciones para brindar una mejor experiencia educativa.
                            </p>
                            <a href="<?php echo e(url('/noticias/mejoras-campus')); ?>" class="read-more">Leer más →</a>
                        </div>
                    </div>
                </div>

                <div class="news-actions">
                    <a href="<?php echo e(url('/noticias')); ?>" class="btn btn-primary">Ver todas las noticias</a>
                    <a href="<?php echo e(url('/noticias/suscribirse')); ?>" class="btn btn-outline">Suscribirse a la Gaceta
                        Diaria</a>
                </div>
            </div>
        </section>

        <!-- Quick Links Section -->
        <?php echo $__env->make('public.partials.quick_links', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </main>

    <!-- Chatbot Widget -->
    <div id="chatbot-widget" class="chatbot-widget">
        <button id="chatbot-toggle" class="chatbot-toggle" aria-label="Abrir Chatbot">
            <img src="<?php echo e(asset('assets/images/chatbot-avatar.gif')); ?>" alt="Chatbot ISTS" class="chatbot-avatar"
                style="width: 64px; height: 64px; object-fit: cover; border-radius: 50%; box-shadow: 0 2px 8px rgba(0,0,0,0.12);">
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
                <input type="text" id="chatbot-input" name="message" placeholder="Escribe tu pregunta..."
                    maxlength="500" required>
                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <!-- Scripts -->
    <script src="<?php echo e(asset('js/main.js')); ?>"></script>
    <script src="<?php echo e(asset('ISTSSYSTEM/js/chatbot.js')); ?>"></script>
    <script src="<?php echo e(asset('js/harvard-interactions.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<pre><?php echo e(json_encode($heroSlides)); ?></pre>

<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/public/home.blade.php ENDPATH**/ ?>