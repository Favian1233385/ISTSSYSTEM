<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eventos - ISTS</title>
    <link rel="stylesheet" href="/css/style.css">
    <!-- Puedes agregar aquí otros estilos o scripts públicos -->

        <link rel="icon" type="image/png" href="/assets/images/logoists.png">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="min-h-screen bg-gray-50">
        <?php echo $__env->make('public.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Encabezado personalizado por sección -->
        <?php echo $__env->yieldContent('header'); ?>
        <!-- Contenido principal -->
        <div class="max-w-7xl mx-auto px-4" style="margin-bottom:2cm; padding-top: 180px;">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
        <?php echo $__env->make('public.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</body>
</html>
<?php /**PATH C:\workspace\ists\resources\views/public/layout.blade.php ENDPATH**/ ?>