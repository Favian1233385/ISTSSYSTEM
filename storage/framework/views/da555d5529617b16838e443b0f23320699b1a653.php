<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? $item->title); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/harvard-style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/harvard-exact.css')); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <?php echo $__env->make('public.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <main id="main-content" class="main-content">
        <!-- Page Header -->
        <section class="campus-page-header">
            <div class="container text-center">
                <h1 class="campus-page-title"><?php echo e($item->title); ?></h1>
                <?php if($item->description): ?>
                    <p class="campus-page-subtitle"><?php echo e($item->description); ?></p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Content Section -->
        <section class="campus-content-area">
            <div class="container">
                <div class="campus-box">
                    <div class="campus-text-content">
                        <?php echo $item->content; ?>


                        
                        <?php if($item->contents()->where('is_active', true)->count() > 0): ?>
                            <div class="campus-associated-contents">
                                <h2>Contenidos y servicios asociados</h2>
                                <?php $__currentLoopData = $item->contents()->where('is_active', true)->orderBy('date', 'desc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="campus-content-block">
                                        <h3><?php echo e($content->title); ?></h3>
                                        <?php if($content->date): ?>
                                            <div class="meta">Fecha: <?php echo e($content->date); ?></div>
                                        <?php endif; ?>
                                        <div class="description"><?php echo $content->description; ?></div>
                                        <?php if($content->external_url): ?>
                                            <div><a href="<?php echo e($content->external_url); ?>" target="_blank" class="btn btn-outline-primary">Enlace externo</a></div>
                                        <?php endif; ?>
                                        <?php if($content->pdf_url): ?>
                                            <div><a href="<?php echo e(asset($content->pdf_url)); ?>" target="_blank" class="btn btn-outline-secondary">Ver PDF</a></div>
                                        <?php endif; ?>
                                        <?php if($content->image_path): ?>
                                            <div class="mb-2"><img src="<?php echo e(asset($content->image_path)); ?>" alt="Imagen asociada" style="max-width:300px;max-height:200px;"></div>
                                        <?php endif; ?>
                                        <?php if($content->image_url): ?>
                                            <div class="mb-2"><img src="<?php echo e($content->image_url); ?>" alt="Imagen externa" style="max-width:300px;max-height:200px;"></div>
                                        <?php endif; ?>
                                        <?php if($content->video_path): ?>
                                            <div class="mb-2"><video src="<?php echo e(asset($content->video_path)); ?>" controls style="max-width:400px;max-height:300px;"></video></div>
                                        <?php endif; ?>
                                        <?php if($content->video_url): ?>
                                            <div class="mb-2"><video src="<?php echo e($content->video_url); ?>" controls style="max-width:400px;max-height:300px;"></video></div>
                                        <?php endif; ?>
                                        <?php if($content->contact_name || $content->contact_email || $content->contact_phone): ?>
                                            <div class="contact-info">
                                                <strong>Contacto:</strong>
                                                <ul>
                                                    <?php if($content->contact_name): ?><li>Nombre: <?php echo e($content->contact_name); ?></li><?php endif; ?>
                                                    <?php if($content->contact_email): ?><li>Email: <a href="mailto:<?php echo e($content->contact_email); ?>"><?php echo e($content->contact_email); ?></a></li><?php endif; ?>
                                                    <?php if($content->contact_phone): ?><li>Teléfono: <?php echo e($content->contact_phone); ?></li><?php endif; ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($content->form_html && !$content->enable_default_form): ?>
                                            <div class="custom-form"><?php echo $content->form_html; ?></div>
                                        <?php endif; ?>
                                        <?php if(isset($content->enable_default_form) && $content->enable_default_form): ?>
                                            <form action="<?php echo e(route('campus-item-contents.form.submit', $content)); ?>" method="POST" enctype="multipart/form-data" class="mt-4">
                                                <?php echo csrf_field(); ?>
                                                <div class="mb-2">
                                                    <label class="form-label">Nombres *</label>
                                                    <input type="text" name="nombres" class="form-control" required>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label">Cédula *</label>
                                                    <input type="text" name="cedula" class="form-control" required>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label">Carrera *</label>
                                                    <input type="text" name="carrera" class="form-control" required>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label">Ciclo *</label>
                                                    <input type="text" name="ciclo" class="form-control" required>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label">Nivel al que va *</label>
                                                    <input type="text" name="nivel" class="form-control" required>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label">Nombre de la institución *</label>
                                                    <input type="text" name="institucion" class="form-control" required>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label">Cargar PDF (opcional)</label>
                                                    <input type="file" name="pdf_file" class="form-control" accept="application/pdf">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Enviar formulario</button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Gallery Section -->
        <?php if($item->images->count() > 0): ?>
        <section class="campus-gallery-section">
            <div class="container">
                <h2 class="gallery-title">Galería de Imágenes</h2>
                <div class="gallery-grid">
                    <?php $__currentLoopData = $item->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="gallery-item">
                            <img src="<?php echo e(asset($image->image_path)); ?>" 
                                 alt="<?php echo e($image->caption ?? $item->title); ?>"
                                 onclick="openImageModal('<?php echo e(asset($image->image_path)); ?>')">
                            <?php if($image->caption): ?>
                                <div class="gallery-caption">
                                    <p><?php echo e($image->caption); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
        <?php endif; ?>
    </main>

    <!-- Modal para ver imagen en grande -->
    <div id="imageModal" style="display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.9);" onclick="closeImageModal()">
        <span style="position: absolute; top: 20px; right: 40px; color: #fff; font-size: 40px; font-weight: bold; cursor: pointer;">&times;</span>
        <img id="modalImage" style="margin: auto; display: block; max-width: 90%; max-height: 90%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
    </div>

    <script>
        function openImageModal(imageSrc) {
            document.getElementById('imageModal').style.display = 'block';
            document.getElementById('modalImage').src = imageSrc;
        }

        function closeImageModal() {
            document.getElementById('imageModal').style.display = 'none';
        }

        // Cerrar con ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeImageModal();
            }
        });
    </script>

    <?php echo $__env->make('public.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <style>
        /* Campus Page Header */
        .campus-page-header {
            background: linear-gradient(135deg, var(--harvard-primary) 0%, var(--harvard-secondary) 100%);
            color: white;
            padding: 8rem 0 3rem;
            margin-top: 0;
            margin-bottom: 3rem;
        }

        .campus-page-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin: 0 0 1rem 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .campus-page-subtitle {
            font-size: 1.2rem;
            opacity: 0.95;
            margin: 0;
        }

        /* Content Area */
        .campus-content-area {
            padding: 2rem 0 3rem;
        }

        /* Campus Box */
        .campus-box {
            background: linear-gradient(135deg, rgba(0, 168, 107, 0.08) 0%, rgba(14, 62, 73, 0.08) 100%);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 2px solid rgba(0, 168, 107, 0.15);
        }

        .campus-text-content {
            padding: 3rem 2.5rem;
            background: rgba(255, 255, 255, 0.95);
            font-size: 1.05rem;
            line-height: 1.8;
            color: #1e293b;
        }

        .campus-text-content h2,
        .campus-text-content h3 {
            color: var(--harvard-secondary);
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .campus-text-content p {
            margin-bottom: 1rem;
            text-align: justify;
        }

        .campus-text-content ul,
        .campus-text-content ol {
            margin-bottom: 1rem;
            padding-left: 2rem;
        }

        .campus-text-content li {
            margin-bottom: 0.5rem;
        }

        /* Gallery Section */
        .campus-gallery-section {
            padding: 2rem 0 4rem;
        }

        .gallery-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--harvard-secondary);
            margin-bottom: 2rem;
            text-align: center;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .gallery-item {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: white;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .gallery-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .gallery-caption {
            padding: 1rem;
            background: #f8f9fa;
        }

        .gallery-caption p {
            margin: 0;
            color: #666;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .campus-page-header {
                padding: 6rem 0 2rem;
            }

            .campus-page-title {
                font-size: 1.75rem;
            }

            .campus-page-subtitle {
                font-size: 1rem;
            }

            .campus-text-content {
                padding: 1.5rem;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</body>
</html>
<?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/public/campus-item.blade.php ENDPATH**/ ?>