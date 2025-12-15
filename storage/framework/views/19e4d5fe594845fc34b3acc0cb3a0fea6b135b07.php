

<?php $__env->startSection('content'); ?>
<div class="admin-content">
    <div class="dashboard-header">
        <h1>⚙️ Configuración del Chatbot</h1>
        <p>Edita el mensaje genérico y los datos de contacto que se mostrarán cuando el chatbot no encuentre respuesta.</p>
    </div>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <form action="<?php echo e(route('admin.chatbot-settings.update')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="form-group">
            <label for="fallback_message">Mensaje genérico</label>
            <textarea name="fallback_message" id="fallback_message" class="form-control tinymce-editor" rows="4" required><?php echo e(old('fallback_message', $setting->fallback_message)); ?></textarea>
            <small class="form-text text-muted">Puedes usar HTML para enlaces (ej: WhatsApp, correo).</small>
        </div>
        <div class="form-group">
            <label for="contact_phone">WhatsApp</label>
            <input type="text" name="contact_phone" id="contact_phone" class="form-control" value="<?php echo e(old('contact_phone', $setting->contact_phone)); ?>">
        </div>
        <div class="form-group">
            <label for="contact_email">Correo electrónico</label>
            <input type="email" name="contact_email" id="contact_email" class="form-control" value="<?php echo e(old('contact_email', $setting->contact_email)); ?>">
        </div>
        <div class="form-group">
            <label for="contact_hours">Horario de atención</label>
            <input type="text" name="contact_hours" id="contact_hours" class="form-control" value="<?php echo e(old('contact_hours', $setting->contact_hours)); ?>">
        </div>
        <div class="form-group">
            <label for="welcome_message">Mensaje de bienvenida</label>
            <textarea name="welcome_message" id="welcome_message" class="form-control tinymce-editor" rows="3"><?php echo e(old('welcome_message', $setting->welcome_message)); ?></textarea>
            <small class="form-text text-muted">Este mensaje se mostrará al iniciar el chat. Puedes usar HTML.</small>
        </div>
        <button type="submit" class="btn btn-primary">Guardar configuración</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.tiny.cloud/1/tr5q9gaoe9ca3hwsq6nah42q8dqhrtqznrl0gd9523anjatx/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea.tinymce-editor',
        height: 200,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        language: 'es',
        branding: false
    });

    // Forzar sincronización de TinyMCE antes de submit
    document.querySelector('form').addEventListener('submit', function(e) {
        if (typeof tinymce !== 'undefined') {
            tinymce.triggerSave();
        }
        // Diagnóstico visual
        setTimeout(function() {
            if (!document.querySelector('.alert-success') && !document.querySelector('.alert-danger')) {
                alert('El formulario fue enviado, pero no se recibió respuesta del servidor. Verifica la consola del navegador para más detalles.');
            }
        }, 1000);
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/chatbot_settings/edit.blade.php ENDPATH**/ ?>