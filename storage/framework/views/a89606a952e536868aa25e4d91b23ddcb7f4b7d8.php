<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo e($content->description ?? ''); ?>">
    <title><?php echo e($content->title ?? 'Contenido - ISTS'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>
    <!-- Header -->
    <?php echo $__env->make('public.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Hero Section -->
    <section class="about-hero">
        <div class="container">
            <h1><?php echo e(is_array($content) ? ($content['title'] ?? 'Contenido') : ($content->title ?? 'Contenido')); ?></h1>
        </div>
    </section>

    <!-- Content -->
    <section class="about-content">
        <div class="container">
            <?php if(!empty($content)): ?>
                
                <?php
                    $isMisionVision = (is_array($content) ? ($content['slug'] ?? null) : ($content->slug ?? null)) === 'mision-y-vision'
                        || (is_array($content) ? ($content['slug'] ?? null) : ($content->slug ?? null)) === 'mision-y-vision-2';
                ?>

                <div class="content-wrapper <?php echo e($isMisionVision ? 'content-layout-two-column' : ''); ?>">
                    
                    <?php if(!empty(is_array($content) ? $content['image_url'] : $content->image_url)): ?>
                        <div class="content-image">
                            <img src="<?php echo e(asset(is_array($content) ? $content['image_url'] : $content->image_url)); ?>" alt="<?php echo e(is_array($content) ? $content['title'] : $content->title); ?>">
                        </div>
                    <?php endif; ?>

                    
                    <div class="content-body">
                        <?php echo is_array($content) ? ($content['content'] ?? '') : ($content->content ?? ''); ?>

                    </div>

                    
                    <?php if(!empty(is_array($content) ? $content['file_url'] : $content->file_url)): ?>
                        <div class="content-file-download">
                            <a href="<?php echo e(asset('storage/' . (is_array($content) ? $content['file_url'] : $content->file_url))); ?>" target="_blank" class="btn btn-primary">
                                Descargar PDF
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                
                <?php if(!empty($children) && count($children) > 0): ?>
                    <div class="subreglamentos-list">
                        <h2 class="mt-8 mb-4 text-2xl font-bold">Subreglamentos</h2>
                        <ul>
                            <?php $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="mb-6 p-4 border rounded shadow">
                                    <?php if(!empty(is_array($child) ? $child['image_url'] : $child->image_url)): ?>
                                        <div class="content-image">
                                            <img src="<?php echo e(asset(is_array($child) ? $child['image_url'] : $child->image_url)); ?>" alt="<?php echo e(is_array($child) ? $child['title'] : $child->title); ?>">
                                        </div>
                                    <?php endif; ?>
                                    <?php
                                        $file = is_array($child) ? ($child['file_url'] ?? $child['url'] ?? null) : ($child->file_url ?? $child->url ?? null);
                                        $isUrl = filter_var($file, FILTER_VALIDATE_URL);
                                    ?>
                                    <?php if(!empty(is_array($child) ? ($child['file_url'] ?? $child['url']) : ($child->file_url ?? $child->url))): ?>
                                        <h3 class="text-xl font-semibold mb-2">
                                            <a href="<?php echo e($isUrl ? $file : asset($file)); ?>" target="_blank" class="text-primary underline"><?php echo e(is_array($child) ? $child['title'] : $child->title); ?></a>
                                        </h3>
                                    <?php else: ?>
                                        <h3 class="text-xl font-semibold mb-2"><?php echo e(is_array($child) ? $child['title'] : $child->title); ?></h3>
                                    <?php endif; ?>
                                    <p class="mb-2"><?php echo e(is_array($child) ? ($child['description'] ?? '') : ($child->description ?? '')); ?></p>
                                    <?php if(!empty(is_array($child) ? ($child['file_url'] ?? $child['url']) : ($child->file_url ?? $child->url))): ?>
                                        <a href="<?php echo e($isUrl ? $file : asset($file)); ?>" target="_blank" class="btn btn-primary mr-2">Ver PDF</a>
                                        <a href="<?php echo e($isUrl ? $file : asset($file)); ?>" download class="btn btn-secondary">Descargar PDF</a>
                                    <?php else: ?>
                                        <span class="text-gray-500">No hay documento PDF</span>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <p>El contenido no está disponible.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <?php echo $__env->make('public.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <style>
        .about-hero {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
            color: var(--color-white);
            padding: 4rem 0;
            text-align: center;
        }

        .about-hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            font-family: var(--font-primary);
        }

        .about-content {
            padding: 4rem 0;
        }

        .content-wrapper {
            max-width: 90%; /* Ocupa más ancho de la pantalla */
            margin: 0 auto;
        }

        .content-image {
            margin-bottom: 2rem;
            text-align: center;
        }

        .content-image img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .content-body {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 2.5rem; /* Add space between content and PDF button */
        }

        /* Ensure images inside the rich text content are responsive */
        .content-body img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .content-file-download {
            text-align: center;
            margin-top: 2rem;
        }

        /* Basic button styling if not provided by main CSS */
        .btn {
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            text-decoration: none;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }

        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            color: #fff;
            background-color: #0069d9;
            border-color: #0062cc;
        }

        /* --- NEW STYLES FOR TWO-COLUMN LAYOUT --- */
        .content-layout-two-column {
            display: flex;
            flex-wrap: wrap; /* Allows items to wrap on smaller screens */
            gap: 2rem; /* Space between image and text */
            align-items: stretch; /* Align items to stretch to the same height */
        }

        .content-layout-two-column .content-image {
            flex: 0 0 40%; /* Imagen toma 40% del ancho */
            max-width: 40%;
            margin-bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .content-layout-two-column .content-image img {
            width: 100%; /* Make image fill its column */
            height: 100%; /* Make image fill the height of its container */
            object-fit: contain; /* Ensure entire image is visible, potentially with whitespace */
        }

        .content-layout-two-column .content-body {
            flex: 0 0 55%; /* Texto toma 55% del ancho */
            max-width: 55%;
            margin-bottom: 0;
        }

        .content-layout-two-column .content-file-download {
            flex-basis: 100%; /* PDF button takes full width below both columns */
            margin-top: 2rem;
            text-align: left; /* Align to the left under two columns */
        }

        /* Responsive adjustments for smaller screens */
        @media (max-width: 768px) {
            .content-layout-two-column {
                flex-direction: column; /* Stack items vertically */
                gap: 1.5rem;
            }

            .content-layout-two-column .content-image,
            .content-layout-two-column .content-body {
                flex: 0 0 100%; /* Both take full width */
                max-width: 100%;
                margin-bottom: 1rem; /* Add some space back between stacked elements */
            }

            .content-layout-two-column .content-image {
                text-align: center; /* Center image when stacked */
            }

            .content-layout-two-column .content-file-download {
                text-align: center; /* Center PDF button when stacked */
            }
        }
    </style>
</body>
</html>
<?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/public/content_detail.blade.php ENDPATH**/ ?>