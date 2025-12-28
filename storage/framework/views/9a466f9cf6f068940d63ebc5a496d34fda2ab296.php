

<?php $__env->startSection('content'); ?>
<div class="card" style="border-radius: 18px; box-shadow: 0 2px 16px rgba(0,158,96,0.10); margin-top: 2.5rem; max-width: 950px; margin-left:auto; margin-right:auto;">
    <div class="card-body p-5">
        <div class="mb-4 d-flex flex-column flex-md-row align-items-center justify-content-between" style="gap:1.2rem;">
            <div>
                <h1 class="fw-bold mb-1" style="font-size:2.1rem; color:#1a3c34; letter-spacing:-1px; display:flex;align-items:center;gap:0.5em;">
                    <span style="font-size:2.2rem;">ℹ️</span> Gestión de Contenido "Acerca"
                </h1>
                <p class="text-muted mb-0">Aquí puedes crear, editar y eliminar las secciones de contenido que aparecen en la página "Acerca".</p>
            </div>
            <a href="<?php echo e(route('about.create')); ?>" class="btn" style="background: linear-gradient(90deg,#009e60,#f9d423 90%); color: #fff; font-weight:600; box-shadow:0 2px 8px rgba(0,158,96,0.15); border-radius: 8px; padding: 0.75rem 1.5rem; font-size:1.1rem; transition:box-shadow .2s;">Crear Nueva Sección</a>
        </div>
        <?php if(session('success')): ?>
            <div class="alert alert-success"><span>✅</span> <?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-danger"><span>❌</span> <?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <div class="table-responsive">
            <table class="table align-middle" style="border-radius: 12px; overflow: hidden;">
                <thead style="background: linear-gradient(90deg,#009e60,#0e3e49 90%); color: #fff;">
                    <tr>
                        <th style="width: 180px;">Título</th>
                        <th>Contenido</th>
                        <th style="width: 220px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $abouts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $about): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td style="font-weight:600;"><?php echo e($about['title']); ?></td>
                        <td><?php echo e(Str::limit(strip_tags(html_entity_decode($about['content'])), 100)); ?></td>
                        <td style="display:flex; flex-direction:column; gap:0.5em; align-items:flex-start;">
                            <div style="display:flex; gap:0.5em;">
                                <a href="<?php echo e(route('about.edit', $about['id'])); ?>" class="btn" style="background: #253b7d; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; min-width:100px; text-align:center;">Editar</a>
                                <form action="<?php echo e(route('about.destroy', $about['id'])); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn" style="background: #e74c3c; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; min-width:100px; text-align:center;" onclick="return confirm('¿Estás seguro de que quieres eliminar esta sección?');">Eliminar</button>
                                </form>
                            </div>
                            <?php if(strtolower($about['title']) === 'autoridades'): ?>
                                <a href="<?php echo e(route('admin.autoridades.create')); ?>" class="btn" style="background: #009e60; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; min-width:100px; text-align:center;">Crear Autoridad</a>
                            <?php endif; ?>
                            <?php if(strtolower($about['title']) === 'planta docente'): ?>
                                <a href="<?php echo e(route('admin.teachers.create')); ?>" class="btn" style="background: #009e60; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; min-width:100px; text-align:center;">Crear Docente</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="3" class="text-center text-muted py-4">No hay secciones de "Acerca" creadas todavía.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/about/index.blade.php ENDPATH**/ ?>