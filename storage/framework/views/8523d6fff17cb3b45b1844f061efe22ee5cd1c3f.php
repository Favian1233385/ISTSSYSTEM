

<?php $__env->startSection('content'); ?>
<div class="admin-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Editar Item del Campus</h1>
        <a href="<?php echo e(route('admin.campus-items.index')); ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="<?php echo e(route('admin.campus-items.update', $campusItem)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-3">
                    <label for="title" class="form-label">Título *</label>
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
                           value="<?php echo e(old('title', $campusItem->title)); ?>" 
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


                <div class="mb-3">
                    <label for="description" class="form-label">Descripción Corta</label>
                    <textarea class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                              id="description" 
                              name="description" 
                              rows="2"><?php echo e(old('description', $campusItem->description)); ?></textarea>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <small class="form-text text-muted">Breve descripción que aparecerá en el menú</small>
                </div>



                <div class="mb-3 form-check">
                    <input type="checkbox" 
                           class="form-check-input" 
                           id="is_external" 
                           name="is_external" 
                           value="1"
                           <?php echo e(old('is_external', $campusItem->is_external) ? 'checked' : ''); ?>

                           onchange="toggleContentField()">
                    <label class="form-check-label" for="is_external">
                        ¿Es un enlace externo?
                    </label>
                    <small class="form-text text-muted d-block">Marcar si el enlace abre una página externa (ej: Biblioteca Digital)</small>
                </div>

                <div class="mb-3">
                    <label for="url" class="form-label">URL *</label>
                    <input type="text" 
                           class="form-control <?php $__errorArgs = ['url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="url" 
                           name="url" 
                           value="<?php echo e(old('url', $campusItem->url)); ?>" 
                           placeholder="/campus/ejemplo"
                           required>
                    <?php $__errorArgs = ['url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <small class="form-text text-muted">Ejemplo: /campus/biblioteca</small>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Categoría *</label>
                    <input type="text" class="form-control <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="category" name="category" value="<?php echo e(old('category', $campusItem->category)); ?>" list="category-suggestions" required>
                    <datalist id="category-suggestions">
                        <option value="servicios">
                        <option value="coordinaciones">
                        <option value="vida_estudiantil">
                        <option value="infraestructura">
                        <option value="biblioteca">
                        <option value="eventos">
                        <option value="vinculacion">
                        <option value="calidad">
                        <option value="idiomas">
                    </datalist>
                    <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <small class="form-text text-muted">Puedes escribir cualquier categoría. Sugerencias: servicios, coordinaciones, vida_estudiantil, infraestructura, biblioteca, eventos, vinculación, calidad, idiomas.</small>
                </div>


                <div class="mb-3">
                    <label class="form-label">Funciones Principales</label>
                    <div id="functions-list">
                        <?php
                            $functions = old('functions', $campusItem->functions ?? []);
                            if (is_string($functions)) {
                                $functions = json_decode($functions, true) ?: [];
                            }
                        ?>
                        <?php $__currentLoopData = $functions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $function): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="input-group mb-2 function-item">
                                <input type="text" name="functions[]" class="form-control" value="<?php echo e($function); ?>" required>
                                <button type="button" class="btn btn-danger btn-remove-function"><i class="fas fa-trash"></i></button>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <button type="button" class="btn btn-outline-primary" id="add-function-btn"><i class="fas fa-plus"></i> Agregar Función</button>
                    <small class="form-text text-muted d-block">Agrega las funciones principales, servicios o atributos de este campus.</small>
                </div>

                <div class="mb-3">
                    <label for="order" class="form-label">Orden *</label>
                    <input type="number" 
                           class="form-control <?php $__errorArgs = ['order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="order" 
                           name="order" 
                           value="<?php echo e(old('order', $campusItem->order)); ?>" 
                           min="0"
                           required>
                    <?php $__errorArgs = ['order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <small class="form-text text-muted">Define el orden de aparición (menor número = más arriba)</small>
                </div>

                <div class="mb-3" id="content-field">
                    <label for="content" class="form-label">Contenido</label>
                    <textarea class="form-control <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                              id="content" 
                              name="content" 
                              rows="15"><?php echo e(old('content', $campusItem->content)); ?></textarea>
                    <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <small class="form-text text-muted">Usa el editor para dar formato al contenido (solo para enlaces internos)</small>
                </div>

                <!-- Imágenes existentes -->
                <?php if($campusItem->images->count() > 0): ?>
                <div class="mb-3">
                    <label class="form-label">Imágenes actuales</label>
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <?php $__currentLoopData = $campusItem->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div style="position: relative; border: 1px solid #ddd; padding: 0.5rem; border-radius: 4px;">
                                <img src="<?php echo e(asset($image->image_path)); ?>" alt="<?php echo e($image->caption); ?>" style="width: 150px; height: 150px; object-fit: cover;">
                                <a href="<?php echo e(route('admin.campus-items.image.destroy', [$campusItem, $image])); ?>" 
                                   onclick="return confirm('¿Eliminar esta imagen?')"
                                   style="position: absolute; top: 0.5rem; right: 0.5rem; background: #dc3545; color: white; padding: 0.25rem 0.5rem; border-radius: 4px; text-decoration: none;">
                                    ✕
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="mb-3" id="images-field">
                    <label for="images" class="form-label">Agregar nuevas imágenes</label>
                    <input type="file" 
                           class="form-control <?php $__errorArgs = ['images.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="images" 
                           name="images[]" 
                           multiple 
                           accept="image/*">
                    <?php $__errorArgs = ['images.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <small class="form-text text-muted">Puedes seleccionar múltiples imágenes (JPG, PNG, GIF)</small>
                </div>

                <div class="mb-3">
                    <label for="pdf_file" class="form-label">Archivo PDF</label>
                    <input type="file" 
                           class="form-control <?php $__errorArgs = ['pdf_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="pdf_file" 
                           name="pdf_file" 
                           accept="application/pdf">
                    <?php $__errorArgs = ['pdf_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <small class="form-text text-muted">Puedes subir un archivo PDF (máx. 10MB)</small>
                </div>


                <?php if($campusItem->pdf_url): ?>
                <div class="mb-3">
                    <label class="form-label">PDF actual</label>
                    <a href="<?php echo e(asset($campusItem->pdf_url)); ?>" target="_blank" class="btn btn-outline-primary">Ver PDF</a>
                </div>
                <?php endif; ?>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="schedule" class="form-label">Horario de Atención</label>
                            <input type="text" class="form-control" id="schedule" name="schedule" value="<?php echo e(old('schedule', $campusItem->schedule)); ?>" placeholder="Ej: Lunes a Viernes, 08:00-16:00">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="location" class="form-label">Dirección / Ubicación</label>
                            <input type="text" class="form-control" id="location" name="location" value="<?php echo e(old('location', $campusItem->location)); ?>" placeholder="Ej: Edif. Central, Planta Baja">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo e(old('phone', $campusItem->phone)); ?>" placeholder="Ej: (07) 274-0421">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo e(old('email', $campusItem->email)); ?>" placeholder="Ej: contacto@istsucua.edu.ec">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="manager" class="form-label">Nombre del Encargado</label>
                    <input type="text" class="form-control" id="manager" name="manager" value="<?php echo e(old('manager', $campusItem->manager)); ?>" placeholder="Ej: Juan Pérez">
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" 
                           class="form-check-input" 
                           id="is_active" 
                           name="is_active" 
                           value="1"
                           <?php echo e(old('is_active', $campusItem->is_active) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="is_active">
                        Activo
                    </label>
                </div>

                <div class="admin-action-buttons mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Actualizar
                    </button>
                    <a href="<?php echo e(route('admin.campus-items.index')); ?>" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-1"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- TinyMCE -->
<script src="https://cdn.tiny.cloud/1/tr5q9gaoe9ca3hwsq6nah42q8dqhrtqznrl0gd9523anjatx/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
// Inicializar TinyMCE
tinymce.init({
    selector: '#content',
    height: 500,
    menubar: true,
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
        'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
    ],
    toolbar: 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
    content_style: 'body { font-family: Inter, -apple-system, BlinkMacSystemFont, sans-serif; font-size: 16px; }',
    language: 'es',
    branding: false,
    promotion: false
});

function toggleContentField() {
    const isExternal = document.getElementById('is_external').checked;
    const contentField = document.getElementById('content-field');
    if (isExternal) {
        contentField.style.display = 'none';
        // Destruir TinyMCE si está activo
        if (tinymce.get('content')) {
            tinymce.get('content').setContent('');
        }
    } else {
        contentField.style.display = 'block';
    }
}

// Funcionalidad dinámica para funciones principales
document.addEventListener('DOMContentLoaded', function() {
    toggleContentField();
    document.getElementById('add-function-btn').addEventListener('click', function() {
        const list = document.getElementById('functions-list');
        const div = document.createElement('div');
        div.className = 'input-group mb-2 function-item';
        div.innerHTML = `<input type="text" name="functions[]" class="form-control" required><button type="button" class="btn btn-danger btn-remove-function"><i class="fas fa-trash"></i></button>`;
        list.appendChild(div);
    });
    document.getElementById('functions-list').addEventListener('click', function(e) {
        if (e.target.closest('.btn-remove-function')) {
            e.target.closest('.function-item').remove();
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/campus-items/edit.blade.php ENDPATH**/ ?>