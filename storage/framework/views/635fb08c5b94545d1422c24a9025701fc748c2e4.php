<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autoridades - ISTS</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <!-- Si usas algún framework CSS como Bootstrap, asegúrate de incluirlo aquí -->
</head>
<body>
    <!-- Header público -->
    <?php echo $__env->make('public.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <main class="main-content py-5">
        <div class="container">
            <h1 class="text-center mb-5">Nuestras Autoridades</h1>

            <?php $__empty_1 = true; $__currentLoopData = $autoridades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $autoridad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="card mb-4 shadow-sm">
                    <div class="row g-0">
                        <?php if($autoridad->foto_path): ?>
                            <div class="col-md-4 text-center d-flex align-items-center justify-content-center">
                                <img src="<?php echo e(asset('storage/' . $autoridad->foto_path)); ?>" class="img-fluid rounded-start p-3" alt="Foto de <?php echo e($autoridad->nombre); ?>" style="max-width: 250px; max-height: 250px; object-fit: cover;">
                            </div>
                        <?php endif; ?>
                        <div class="col-md-<?php echo e($autoridad->foto_path ? '8' : '12'); ?>">
                            <div class="card-body">
                                <h3 class="card-title"><?php echo e($autoridad->nombre); ?></h3>
                                <h5 class="card-subtitle mb-2 text-muted"><?php echo e($autoridad->cargo); ?> (<?php echo e($autoridad->categoria); ?>)</h5>
                                <?php if($autoridad->biografia): ?>
                                    <div class="card-text"><?php echo $autoridad->biografia; ?></div>
                                <?php endif; ?>
                                <?php if($autoridad->pdf_path): ?>
                                    <a href="<?php echo e(asset('storage/' . $autoridad->pdf_path)); ?>" target="_blank" class="btn btn-primary mt-3">Descargar Currículum (PDF)</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="alert alert-info text-center" role="alert">
                    No hay autoridades registradas en este momento.
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- Footer público -->
    <?php echo $__env->make('public.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <style>
        /* Estilos básicos para la página de autoridades */
        .main-content {
            padding-top: 100px; /* Ajusta según la altura de tu header fijo */
        }
        .text-center { text-align: center; }
        .mb-5 { margin-bottom: 3rem; }
        .mb-4 { margin-bottom: 1.5rem; }
        .shadow-sm { box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important; }
        .card { border: 1px solid rgba(0,0,0,.125); border-radius: .25rem; }
        .row.g-0 { display: flex; flex-wrap: wrap; margin-right: 0; margin-left: 0; }
        .col-md-4, .col-md-8, .col-md-12 { flex: 0 0 auto; width: 100%; }
        @media (min-width: 768px) {
            .col-md-4 { width: 33.333333%; }
            .col-md-8 { width: 66.666667%; }
        }
        .d-flex { display: flex!important; }
        .align-items-center { align-items: center!important; }
        .justify-content-center { justify-content: center!important; }
        .img-fluid { max-width: 100%; height: auto; }
        .rounded-start { border-top-left-radius: .25rem; border-bottom-left-radius: .25rem; }
        .p-3 { padding: 1rem!important; }
        .card-body { flex: 1 1 auto; padding: 1.25rem; }
        .card-title { font-size: 1.75rem; margin-bottom: .75rem; }
        .card-subtitle { font-size: 1rem; color: #6c757d; }
        .card-text { margin-top: 1rem; }
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
        .mt-3 { margin-top: 1rem!important; }
        .alert {
            position: relative;
            padding: .75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: .25rem;
        }
        .alert-info {
            color: #0c5460;
            background-color: #d1ecf1;
            border-color: #bee5eb;
        }
    </style>
</body>
</html>
<?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/public/autoridades/index.blade.php ENDPATH**/ ?>