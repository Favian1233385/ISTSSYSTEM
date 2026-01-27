

<?php $__env->startSection('title', 'Editar Sección de Visitar'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">✏️ Editar Sección: <?php echo e($visitSection->title); ?></h1>
                <a href="<?php echo e(route('admin.visit-sections.index')); ?>" class="btn btn-secondary">
                    ← Volver al Listado
                </a>
            </div>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Errores de validación:</strong>
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <form action="<?php echo e(route('admin.visit-sections.update', $visitSection->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

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
                               value="<?php echo e(old('title', $visitSection->title)); ?>" 
                               required>
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
                        <label for="slug" class="form-label">Slug (URL)</label>
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
                               value="<?php echo e(old('slug', $visitSection->slug)); ?>">
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
                        <small class="text-muted">URL: /visitar/<?php echo e($visitSection->slug); ?></small>
                    </div>
                </div>

                <!-- Misión -->
                <div class="mb-3">
                    <label for="mission" class="form-label">Misión / Descripción</label>
                    <textarea class="form-control <?php $__errorArgs = ['mission'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                              id="mission" 
                              name="mission" 
                              rows="4"><?php echo e(old('mission', $visitSection->mission)); ?></textarea>
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
                        <?php
                            $functions = old('functions', $visitSection->functions ?? []);
                        ?>
                        <?php if(!empty($functions)): ?>
                            <?php $__currentLoopData = $functions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $function): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="input-group mb-2 function-item">
                                    <input type="text" 
                                           class="form-control" 
                                           name="functions[]" 
                                           value="<?php echo e($function); ?>">
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
                               value="<?php echo e(old('schedule', $visitSection->schedule)); ?>">
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
                               value="<?php echo e(old('location', $visitSection->location)); ?>">
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
                               value="<?php echo e(old('phone', $visitSection->phone)); ?>">
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
                               value="<?php echo e(old('email', $visitSection->email)); ?>">
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
                    <label for="additional_info" class="form-label">Información Adicional</label>
                    <textarea class="form-control <?php $__errorArgs = ['additional_info'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                              id="additional_info" 
                              name="additional_info" 
                              rows="3"><?php echo e(old('additional_info', $visitSection->additional_info)); ?></textarea>
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
                               value="<?php echo e(old('sort_order', $visitSection->sort_order)); ?>"
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
                    </div>

                    <!-- Estado -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label d-block">Estado</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="is_active" 
                                   name="is_active" 
                                   <?php echo e(old('is_active', $visitSection->is_active) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="is_active">
                                Sección Activa
                            </label>
                        </div>
                    </div>
                </div>

                <div class="admin-action-buttons">
                    <a href="<?php echo e(route('admin.visit-sections.index')); ?>" class="btn btn-secondary shadow-sm fw-semibold border-0 d-flex align-items-center justify-content-center">
                        <i class="bi bi-x-circle me-2"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary shadow-sm fw-semibold border-0 d-flex align-items-center justify-content-center">
                        <i class="bi bi-save me-2"></i> Actualizar Sección
                    </button>
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

    // Eliminar función
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
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ists\resources\views/admin/visit-sections/edit.blade.php ENDPATH**/ ?>