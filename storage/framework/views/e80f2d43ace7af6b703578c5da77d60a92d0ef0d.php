

<?php $__env->startSection('title', 'Crear Sección de Visitar'); ?>

<?php $__env->startSection('content'); ?>

<div class="container my-4">
    <div class="card shadow-sm mx-auto" style="max-width:900px;">
        <div class="card-body pb-0">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="d-flex align-items-center gap-3">
                    <span style="font-size:2.2rem; color:#2563eb;">➕</span>
                    <h2 class="fw-bold mb-0" style="font-size:1.7rem; letter-spacing:0.5px;">Crear Sección de Visitar</h2>
                </div>
                <a href="<?php echo e(route('admin.visit-sections.index')); ?>" class="btn btn-outline-primary fw-bold">← Volver</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="<?php echo e(route('admin.visit-sections.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="row">
                    <!-- Título -->
                    <div class="col-md-8 mb-3">
                        <label for="title" class="form-label">Título de la Sección *</label>
                        <input type="text" 
                               class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="title" 
                               name="title" 
                               value="<?php echo e(old('title')); ?>" 
                               required
                               placeholder="Ej: Secretaría General">
                        <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Slug -->
                    <div class="col-md-4 mb-3">
                        <label for="slug" class="form-label">
                            Slug (URL) 
                            <small class="text-muted">(opcional, se genera automático)</small>
                        </label>
                        <input type="text" 
                               class="form-control <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="slug" 
                               name="slug" 
                               value="<?php echo e(old('slug')); ?>"
                               placeholder="secretaria-general">
                        <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <small class="text-muted">Se usará en la URL: /visitar/slug</small>
                    </div>
                </div>

                <!-- Misión -->
                <div class="mb-3">
                    <label for="mission" class="form-label fw-bold text-primary">Misión / Descripción</label>
                    <textarea class="form-control tinymce-editor <?php $__errorArgs = ['mission'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                              id="mission" 
                              name="mission" 
                              rows="6"
                              placeholder="Describe la misión y propósito de esta sección..."><?php echo e(old('mission')); ?></textarea>
                    <?php $__errorArgs = ['mission'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Funciones -->
                <div class="mb-3">
                    <label class="form-label">Funciones Principales</label>
                    <div id="functions-container">
                        <?php if(old('functions')): ?>
                            <?php $__currentLoopData = old('functions'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $function): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="input-group mb-2 function-item">
                                    <input type="text" 
                                           class="form-control" 
                                           name="functions[]" 
                                           value="<?php echo e($function); ?>"
                                           placeholder="Describe una función...">
                                    <button type="button" class="btn btn-danger remove-function">🗑️</button>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="input-group mb-2 function-item">
                                <input type="text" class="form-control" name="functions[]" placeholder="Describe una función...">
                                <button type="button" class="btn btn-danger remove-function">🗑️</button>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button type="button" class="btn btn-sm btn-success" id="add-function">
                        ➕ Agregar Función
                    </button>
                </div>

                <div class="row">
                    <!-- Horario -->
                    <div class="col-md-6 mb-3">
                        <label for="schedule" class="form-label">Horario de Atención</label>
                        <input type="text" 
                               class="form-control <?php $__errorArgs = ['schedule'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="schedule" 
                               name="schedule" 
                               value="<?php echo e(old('schedule')); ?>"
                               placeholder="Lunes a Viernes, 08:00 - 17:00">
                        <?php $__errorArgs = ['schedule'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Ubicación -->
                    <div class="col-md-6 mb-3">
                        <label for="location" class="form-label">Ubicación</label>
                        <input type="text" 
                               class="form-control <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="location" 
                               name="location" 
                               value="<?php echo e(old('location')); ?>"
                               placeholder="Edificio Administrativo, Planta Baja">
                        <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="row">
                    <!-- Teléfono -->
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="text" 
                               class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="phone" 
                               name="phone" 
                               value="<?php echo e(old('phone')); ?>"
                               placeholder="(07) 274-0XXX ext. 101">
                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" 
                               class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="email" 
                               name="email" 
                               value="<?php echo e(old('email')); ?>"
                               placeholder="seccion@istssucua.edu.ec">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- Información Adicional -->
                <div class="mb-3">
                    <label for="additional_info" class="form-label fw-bold text-primary">Información Adicional</label>
                    <textarea class="form-control tinymce-editor <?php $__errorArgs = ['additional_info'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                              id="additional_info" 
                              name="additional_info" 
                              rows="4"
                              placeholder="Cualquier información extra que desees agregar..."><?php echo e(old('additional_info')); ?></textarea>
                    <?php $__errorArgs = ['additional_info'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <?php $__env->startPush('scripts'); ?>
                <script src="https://cdn.tiny.cloud/1/tr5q9gaoe9ca3hwsq6nah42q8dqhrtqznrl0gd9523anjatx/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
                <script>
                    tinymce.init({
                        selector: 'textarea.tinymce-editor',
                        height: 300,
                        menubar: true,
                        plugins: [
                            'advlist autolink lists link image charmap preview anchor',
                            'searchreplace visualblocks code fullscreen',
                            'insertdatetime media table paste code help wordcount',
                            'align'
                        ],
                        toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
                        language: 'es',
                    });
                    document.addEventListener('DOMContentLoaded', function() {
                        var form = document.querySelector('form[action][method="POST"]');
                        if (form) {
                            form.addEventListener('submit', function(e) {
                                if (window.tinymce) {
                                    tinymce.triggerSave();
                                }
                            });
                        }
                    });
                </script>
                <?php $__env->stopPush(); ?>
                </div>

                <div class="row">
                    <!-- Orden -->
                    <div class="col-md-6 mb-3">
                        <label for="sort_order" class="form-label">Orden de Aparición</label>
                        <input type="number" 
                               class="form-control <?php $__errorArgs = ['sort_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="sort_order" 
                               name="sort_order" 
                               value="<?php echo e(old('sort_order', 0)); ?>"
                               min="0">
                        <?php $__errorArgs = ['sort_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <small class="text-muted">Menor número aparece primero</small>
                    </div>

                    <!-- Estado -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label d-block">Estado</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="is_active" 
                                   name="is_active" 
                                   <?php echo e(old('is_active', true) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="is_active">
                                Sección Activa
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end align-items-center mt-4" style="gap:1rem; margin-bottom:0;">
                    <div style="display:flex; align-items:center; gap:1rem;">
                        <a href="<?php echo e(route('admin.visit-sections.index')); ?>" class="btn btn-secondary shadow-sm fw-semibold border-0 d-flex align-items-center justify-content-center" style="min-width:130px; height:48px; border-radius:10px; font-size:1.08rem; transition:box-shadow .2s,background .2s; margin-bottom:0;">
                            <i class="bi bi-x-circle me-2"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary shadow-sm fw-semibold border-0 d-flex align-items-center justify-content-center" style="min-width:170px; height:48px; border-radius:10px; font-size:1.08rem; transition:box-shadow .2s,background .2s; margin-bottom:0;">
                            <i class="bi bi-save me-2"></i> Guardar Sección
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Agregar función
    document.getElementById('add-function').addEventListener('click', function() {
        const container = document.getElementById('functions-container');
        const newItem = document.createElement('div');
        newItem.className = 'input-group mb-2 function-item';
        newItem.innerHTML = `
            <input type="text" class="form-control" name="functions[]" placeholder="Describe una función...">
            <button type="button" class="btn btn-danger remove-function">🗑️</button>
        `;
        container.appendChild(newItem);
    });

    // Eliminar función (delegación de eventos)
    document.getElementById('functions-container').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-function') || e.target.parentElement.classList.contains('remove-function')) {
            const button = e.target.classList.contains('remove-function') ? e.target : e.target.parentElement;
            const item = button.closest('.function-item');
            if (document.querySelectorAll('.function-item').length > 1) {
                item.remove();
            } else {
                alert('Debe haber al menos una función');
            }
        }
    });

    // Auto-generar slug desde el título
    document.getElementById('title').addEventListener('input', function(e) {
        const slugInput = document.getElementById('slug');
        if (!slugInput.value || slugInput.dataset.manuallyEdited !== 'true') {
            const slug = e.target.value
                .toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '') // Remover acentos
                .replace(/[^a-z0-9\s-]/g, '') // Solo letras, números, espacios y guiones
                .trim()
                .replace(/\s+/g, '-'); // Reemplazar espacios con guiones
            slugInput.value = slug;
        }
    });

    // Marcar slug como editado manualmente
    document.getElementById('slug').addEventListener('input', function() {
        this.dataset.manuallyEdited = 'true';
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/visit-sections/create.blade.php ENDPATH**/ ?>