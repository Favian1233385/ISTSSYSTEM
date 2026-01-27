

<?php $__env->startSection('title', 'Mensajes del Chatbot'); ?>

<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>
<?php if(session('error')): ?>
    <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
<?php endif; ?>
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-info d-flex justify-content-between align-items-center">
                <div>
                    <strong>¿Deseas configurar el asistente virtual?</strong> Puedes editar el mensaje de bienvenida, mensaje genérico y contactos desde la <a href="<?php echo e(route('admin.chatbot-settings.edit')); ?>" class="alert-link">Configuración del Chatbot</a>.
                </div>
                <a href="<?php echo e(route('admin.chatbot-settings.edit')); ?>" class="btn btn-primary btn-sm">Ir a configuración</a>
            </div>
        </div>
    </div>
    <!-- Aquí continúa la gestión de mensajes del chatbot (historial, filtros, etc.) si lo necesitas -->
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ists\resources\views/admin/chatbot/index.blade.php ENDPATH**/ ?>