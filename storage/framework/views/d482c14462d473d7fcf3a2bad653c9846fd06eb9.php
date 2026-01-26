

<?php $__env->startSection('title', 'ISTS Sucúa - Instituto Superior Tecnológico Sucúa'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Main Content -->
    <main id="main-content" class="main-content p-0 m-0" style="position:relative;">
        <!-- Hero Section -->
        <section class="hero-section p-0 m-0" style="height:100vh; min-height:100vh; overflow:hidden; z-index:1; position:relative;">
            <?php if(isset($heroSlides) && $heroSlides->count() > 0): ?>
                <div id="heroCarousel" class="carousel slide h-100" data-bs-ride="carousel" data-bs-interval="5000" style="z-index:1; position:relative;">
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
                                <img src="<?php echo e(asset('storage/uploads/images/' . $slide->image_path)); ?>"
                                    class="d-block w-100 h-100 object-fit-cover" alt="<?php echo e($slide->title); ?>"
                                    style="object-fit:cover;"
                                    onerror="this.src='<?php echo e(asset('storage/uploads/images/placeholder.jpg')); ?>'">

                                <div
                                    class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100">
                                    <div class="p-4 rounded-4"
                                        style="background:rgba(30,30,30,0.03); backdrop-filter:blur(4px); box-shadow:0 2px 8px rgba(0,0,0,0.03); max-width:700px; width:100%;">
                                        <h1 class="fw-bold text-white"
                                            style="font-size:4.2rem; text-shadow:0 2px 12px rgba(0,0,0,0.5); line-height:1.1;">
                                            <?php echo e($slide->title); ?>

                                        </h1>
                                        <p class="lead text-white mb-4"
                                            style="font-size:2rem; text-shadow:0 1px 8px rgba(0,0,0,0.35); line-height:1.2;">
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
                    <h2 style="
                        font-size:2.3rem;
                        font-weight:800;
                        color:#00796b;
                        margin-bottom:0.7rem;
                        letter-spacing:-1px;
                        text-align:center;
                        position:relative;">
                        ¡Tenemos una carrera para ti!
                        <span style="display:block; height:4px; width:54px; background:linear-gradient(90deg,#1abc9c,#3498db); border-radius:2px; margin:10px auto 0 auto;"></span>
                    </h2>
                    <p style="font-size:1.18rem; color:#1976d2; text-align:center; max-width:700px; margin:0 auto 1.7rem auto; font-weight:500;">
                        Descubre nuestras ofertas académicas diseñadas para el futuro, con carreras tecnológicas de alto impacto y formación docente de excelencia.
                    </p>
                </div>
                <div class="careers-grid">
                    <?php $__currentLoopData = $careers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $career): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="career-card has-image">
                            <div class="career-banner-thumb" style="width:100%;height:140px;overflow:hidden;position:relative;background:#e8f5f1;">
                                <?php if($career->image_path): ?>
                                    <img src="<?php echo e(asset('storage/' . $career->image_path)); ?>" alt="<?php echo e($career->name); ?>" style="width:100%;height:100%;object-fit:cover;object-position:center;display:block;">
                                <?php elseif($career->image_path_2): ?>
                                    <img src="<?php echo e(asset('storage/' . $career->image_path_2)); ?>" alt="<?php echo e($career->name); ?>" style="width:100%;height:100%;object-fit:cover;object-position:center;display:block;">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('storage/uploads/images/placeholder.jpg')); ?>" alt="<?php echo e($career->name); ?>" style="width:100%;height:100%;object-fit:cover;object-position:center;display:block;">
                                <?php endif; ?>
                            </div>
                            <div class="career-info">
                                <h3 style="text-align: center; color: var(--color-primary);">
                                    <a href="<?php echo e(route('career.show', $career->slug)); ?>"><?php echo e($career->name); ?></a>
                                </h3>
                                <?php if($career->description): ?>
                                    <p><?php echo e(Str::limit($career->description, 100)); ?></p>
                                <?php endif; ?>
                                <a href="<?php echo e(route('career.show', $career->slug)); ?>" class="btn btn-primary">Más información</a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <!-- Botón 'Ver todas las carreras' eliminado por solicitud -->
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
                <div class="section-header" style="text-align:center;">
                    <h2 style="
                        font-size:2.3rem;
                        font-weight:800;
                        color:#00796b;
                        margin-bottom:0.7rem;
                        letter-spacing:-1px;
                        display:inline-block;
                        position:relative;">
                        La Gaceta del ISTS
                        <span style="display:block; height:4px; width:54px; background:linear-gradient(90deg,#1abc9c,#3498db); border-radius:2px; margin:10px auto 0 auto;"></span>
                    </h2>
                    <p style="font-size:1.18rem; color:#1976d2; text-align:center; max-width:700px; margin:0 auto 1.7rem auto; font-weight:500;">
                        Noticias oficiales del Instituto Superior Tecnológico Sucúa sobre ciencia, tecnología, vida del campus, temas universitarios y preocupaciones nacionales y globales más amplias.
                    </p>
                </div>

                <div class="news-grid">
                    <?php $__empty_1 = true; $__currentLoopData = $gacetaList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="news-card <?php if($loop->first): ?> featured <?php endif; ?>">
                            <div class="news-image">
                                <?php
                                    $imgSrc = null;
                                    if(is_array($n->images) && count($n->images) > 0) {
                                        $imgSrc = asset('storage/' . ltrim($n->images[0], '/'));
                                    } elseif($n->is_event && isset($n->image_path) && $n->image_path) {
                                        $imgSrc = asset('storage/uploads/images/' . $n->image_path);
                                    } else {
                                        $imgSrc = asset('storage/uploads/images/placeholder.jpg');
                                    }
                                ?>
                                <img src="<?php echo e($imgSrc); ?>" alt="<?php echo e($n->title); ?>" style="width:100%; height:220px; object-fit:cover; object-position:center; display:block;">
                            </div>
                            <div class="news-content">
                                <span class="news-category">
                                    <?php if($n->is_event): ?>
                                        Evento
                                    <?php else: ?>
                                        <?php echo e(ucfirst($n->category ?? 'Noticias')); ?>

                                    <?php endif; ?>
                                </span>
                                <h3><?php echo e($n->title); ?></h3>
                                <p><?php echo e(\Illuminate\Support\Str::limit(strip_tags(html_entity_decode($n->summary)), 120)); ?></p>
                                <?php if($n->is_event): ?>
                                    <a href="<?php echo e(url('/eventos/' . $n->id)); ?>" class="read-more">Leer más →</a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('noticias.show', $n->slug)); ?>" class="read-more">Leer más →</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p>No hay noticias recientes.</p>
                    <?php endif; ?>
                </div>

                <div class="news-actions">
                    <a href="<?php echo e(url('/noticias')); ?>" class="btn btn-primary">Ver todas las noticias</a>
                </div>
            </div>
        </section>

        <!-- Quick Links Section -->
        <?php echo $__env->make('public.partials.quick_links', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Flotantes solo en el área principal -->
        <div class="floating-social-container" style="position:absolute; left:24px; bottom:120px; z-index:9999;">
            <!-- Chatbot Widget -->
            <div id="chatbot-widget" class="chatbot-widget">
                <button id="chatbot-toggle" class="chatbot-toggle" aria-label="Abrir Chatbot">
                    <img src="<?php echo e(asset('assets/images/chatbot-avatar.gif')); ?>" alt="Chatbot ISTS" class="chatbot-avatar"
                        style="width: 64px; height: 64px; object-fit: cover; border-radius: 50%; box-shadow: 0 2px 8px rgba(0,0,0,0.12);">
                </button>

                <div id="chatbot-window" class="chatbot-window" style="display: none;">
                    <div class="chatbot-header" style="display: flex; align-items: center; justify-content: space-between;">
                        <h3 style="margin:0;">Asistente Virtual ISTS</h3>
                        <div style="display: flex; gap: 8px;">
                            <button id="chatbot-clear-history" title="Eliminar historial" style="background: none; border: none; color: #fff; font-size: 18px; cursor: pointer;">🗑️</button>
                            <button id="chatbot-close" aria-label="Cerrar Chatbot">✕</button>
                        </div>
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

            <!-- Redes sociales flotantes lado izquierdo -->
            <div id="social-widget"
                 style="position:fixed; bottom:7.5rem; left:1.5rem; z-index:2147483646; display:flex; flex-direction:column; gap:12px; align-items:center;">
                <?php
                    $socialLinks = \App\Models\SocialLink::where('active', true)->orderBy('id')->get();
                ?>
                <?php $__currentLoopData = $socialLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e($link->url); ?>" target="_blank" rel="noopener" title="<?php echo e(ucfirst($link->name)); ?>"
                       style="background:<?php echo e($link->bg_color); ?>; border-radius:50%; width:44px; height:44px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 8px rgba(0,0,0,0.12);">
                        <?php echo $link->icon_svg; ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <!-- Widget flotante de eventos, circular, animado y llamativo -->
                <a href="<?php echo e(url('/eventos')); ?>" id="eventos-fab" title="Ver eventos ISTS"
                   style="background: linear-gradient(135deg, #10b981 60%, #f9d423 100%); box-shadow: 0 4px 16px rgba(16,185,129,0.18); border-radius: 50%; width: 64px; height: 64px; display: flex; align-items: center; justify-content: center; margin-top: 10px; position: relative; animation: pulse-eventos 1.5s infinite; transition: transform 0.2s;">
                    <span style="font-size:2.1rem; color:#fff; display:flex; align-items:center; justify-content:center;">
                        <svg width="32" height="32" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="16" cy="16" r="16" fill="#10b981"/><path d="M10 14h12v8a2 2 0 0 1-2 2H12a2 2 0 0 1-2-2v-8Zm12-2V9a2 2 0 0 0-2-2h-1V6a1 1 0 1 0-2 0v1h-2V6a1 1 0 1 0-2 0v1h-1a2 2 0 0 0-2 2v3h12Z" fill="#fff"/></svg>
                    </span>
                    <span style="position:absolute; bottom:-28px; left:50%; transform:translateX(-50%); background:#fff; color:#10b981; font-weight:700; font-size:0.98rem; border-radius:8px; padding:2px 12px; box-shadow:0 2px 8px rgba(16,185,129,0.10); white-space:nowrap;">EVENTOS</span>
                </a>
                <style>
                    @keyframes pulse-eventos {
                        0% { box-shadow: 0 0 0 0 rgba(16,185,129,0.25); }
                        70% { box-shadow: 0 0 0 16px rgba(16,185,129,0.0); }
                        100% { box-shadow: 0 0 0 0 rgba(16,185,129,0.25); }
                    }
                    #eventos-fab:hover {
                        transform: scale(1.08) rotate(-3deg);
                        box-shadow: 0 6px 24px rgba(249,212,35,0.18);
                    }
                </style>
            </div>
        </div>
        
        </style>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <!-- Scripts -->
    <script src="<?php echo e(asset('js/main.js')); ?>"></script>
   
    <script src="<?php echo e(asset('js/harvard-interactions.js')); ?>"></script>
    <script src="<?php echo e(asset('js/dropdown-fix.js')); ?>"></script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ists\resources\views/public/home.blade.php ENDPATH**/ ?>