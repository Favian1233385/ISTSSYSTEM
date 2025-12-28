

<?php $__env->startSection('content'); ?>
<div class="content-header d-flex justify-content-between align-items-center mb-4" style="gap: 1rem;">
    <div>
        <h1 class="fw-bold mb-1" style="font-size:2rem;display:flex;align-items:center;gap:0.5rem;">
            <span style="font-size:2.2rem;">✏️</span> Editar Actualización
        </h1>
        <p class="text-muted mb-0">Modifica la información de la noticia o actualización seleccionada</p>
    </div>
    <a href="<?php echo e(route('admin.updates.index')); ?>" class="btn btn-secondary" style="border-radius:8px; font-weight:500; padding: 0.65rem 1.3rem; font-size:1.05rem;">← Volver</a>
</div>

<div class="card" style="border-radius: 16px; box-shadow: 0 2px 12px rgba(0,158,96,0.08);">
    <div class="card-body p-4">
        <form action="<?php echo e(route('admin.updates.update', $update->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="form-group mb-4">
                <label for="description" class="fw-semibold mb-2">Descripción *</label>
                <textarea id="description" name="description" class="form-control tinymce-editor <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="8" required><?php echo e(old('description', $update->description)); ?></textarea>
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
                <small class="form-text">Descripción de la actualización o novedad. Puedes centrar, enumerar y dar formato al texto.</small>
            </div>
            <div class="row mb-4" style="gap: 1.5rem;">
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="image" class="fw-semibold mb-2">Imagen</label>
                        <?php if($update->image_path): ?>
                            <div class="mb-3">
                                <img src="<?php echo e(asset('storage/' . $update->image_path)); ?>" alt="<?php echo e($update->title); ?>" style="max-width: 220px; border-radius: 12px; box-shadow:0 2px 8px rgba(0,158,96,0.10);">
                                <p class="text-muted small mt-1">Imagen actual</p>
                            </div>
                        <?php endif; ?>
                        <input type="file" id="image" name="image" class="form-control-file <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept="image/*">
                        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <small class="form-text">Subir nueva imagen reemplazará la actual (máx. 2MB)</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label class="fw-semibold mb-2">Video y Enlaces</label>
                        <div class="card shadow-sm" style="border-radius: 12px;">
                            <div class="card-body" style="border-radius: 12px;">
                                <?php if($update->video_path): ?>
                                    <div class="mb-3">
                                        <video controls style="max-width: 100%; border-radius: 8px;">
                                            <source src="<?php echo e(asset('storage/' . $update->video_path)); ?>" type="video/mp4">
                                            Tu navegador no soporta el video.
                                        </video>
                                        <p class="text-muted small mt-1">Video actual subido</p>
                                    </div>
                                <?php elseif($update->video_url): ?>
                                    <div class="mb-3">
                                        <p class="text-muted">URL de video actual: <a href="<?php echo e($update->video_url); ?>" target="_blank"><?php echo e($update->video_url); ?></a></p>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group mb-3">
                                    <label for="video" class="fw-semibold">Subir Video Local</label>
                                    <input type="file" id="video" name="video" class="form-control-file <?php $__errorArgs = ['video'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept="video/*">
                                    <?php $__errorArgs = ['video'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <small class="form-text">Formatos: MP4, AVI, MOV, WMV, FLV, WebM (máx. 50MB)</small>
                                </div>
                                <div class="text-center my-3">
                                    <strong>- O -</strong>
                                </div>
                                <div style="display: flex; flex-direction: column; align-items: stretch; gap: 1.1rem; width: 100%;">
                                    <div class="form-group mb-0">
                                        <label for="video_url" class="fw-semibold">URL de Video (YouTube, Vimeo, etc.)</label>
                                        <input type="url" id="video_url" name="video_url" class="form-control <?php $__errorArgs = ['video_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('video_url', $update->video_url)); ?>" placeholder="https://www.youtube.com/watch?v=..." style="border-radius: 8px; padding: 0.7em 1em; width: 100%; min-width: 0;">
                                        <?php $__errorArgs = ['video_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <small class="form-text">Si subes un nuevo video local, esta URL será ignorada</small>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label for="link_url" class="fw-semibold">URL de Enlace</label>
                                        <input type="url" id="link_url" name="link_url" class="form-control <?php $__errorArgs = ['link_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('link_url', $update->link_url)); ?>" placeholder="https://..." style="border-radius: 8px; padding: 0.7em 1em; width: 100%; min-width: 0;">
                                        <?php $__errorArgs = ['link_url'];
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
                                    <div class="form-group mb-0">
                                        <label for="link_text" class="fw-semibold">Texto del Enlace</label>
                                        <input type="text" id="link_text" name="link_text" class="form-control <?php $__errorArgs = ['link_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('link_text', $update->link_text ?? 'Leer más')); ?>" maxlength="100" style="border-radius: 8px; padding: 0.7em 1em; width: 100%; min-width: 0;">
                                        <?php $__errorArgs = ['link_text'];
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
                                    <div class="form-group mb-0">
                                        <label for="sort_order" class="fw-semibold">Orden</label>
                                        <input type="number" id="sort_order" name="sort_order" class="form-control <?php $__errorArgs = ['sort_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('sort_order', $update->sort_order)); ?>" style="border-radius: 8px; padding: 0.7em 1em; width: 100%; min-width: 0;">
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
                                        <small class="form-text">Número menor = aparece primero</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <div class="form-group mb-0">
                    <label class="checkbox-label fw-semibold" style="display:flex;align-items:center;gap:0.5em;">
                        <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', $update->is_active) ? 'checked' : ''); ?> style="width: 1.2em; height: 1.2em;">
                        <span>Mostrar en la página principal</span>
                    </label>
                </div>
            </div>

            <div class="form-actions" style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem;">
                <button type="submit" class="btn d-flex align-items-center gap-1" style="background: linear-gradient(90deg,#009e60,#0e3e49 90%); color: #fff; font-weight:600; box-shadow:0 2px 8px rgba(0,158,96,0.15); border-radius: 8px; padding: 0.65rem 1.3rem; font-size:1.05rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <polyline points="17 21 17 13 7 13 7 21"></polyline>
                        <polyline points="7 3 7 8 15 8"></polyline>
                    </svg>
                    Actualizar
                </button>
                <a href="<?php echo e(route('admin.updates.index')); ?>" class="btn btn-secondary" style="border-radius:8px; font-weight:500; padding: 0.65rem 1.3rem; font-size:1.05rem;">Cancelar</a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/updates/edit.blade.php ENDPATH**/ ?>