<?php $__env->startSection('content'); ?>
<div class="card" style="border-radius: 18px; box-shadow: 0 2px 16px rgba(0,158,96,0.10); margin-top: 2.5rem; max-width: 1200px; margin-left:auto; margin-right:auto;">
    <div class="card-body p-5">
        <div class="mb-4 d-flex flex-column flex-md-row align-items-center justify-content-between" style="gap:1.2rem;">
            <div>
                <h1 class="fw-bold mb-0" style="font-size:2.1rem; color:#1a3c34; letter-spacing:-1px; display:flex;align-items:center;gap:0.5em;">
                    <span style="font-size:2.2rem;">👩‍🏫</span> Gestión de Planta Docente
                </h1>
                <p class="text-muted mb-0" style="font-size:1.1rem;">Administra la planta docente del instituto.</p>
            </div>
            <a href="<?php echo e(route('admin.teachers.create')); ?>" class="btn" style="background: linear-gradient(90deg,#009e60,#f9d423 90%); color: #fff; font-weight:600; box-shadow:0 2px 8px rgba(0,158,96,0.15); border-radius: 8px; padding: 0.75rem 1.5rem; font-size:1.1rem; transition:box-shadow .2s;">+ Añadir Docente</a>
        </div>
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert"><?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="table-responsive">
            <table class="table align-middle" style="border-radius: 12px; overflow: hidden;">
                <thead style="background: linear-gradient(90deg,#009e60,#0e3e49 90%); color: #fff;">
                    <tr>
                        <th>Orden</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Título</th>
                        <th>Departamento</th>
                        <th>PDF</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->order); ?></td>
                            <td>
                                <?php if($item->image_path): ?>
                                    <img src="<?php echo e(asset('storage/' . $item->image_path)); ?>" alt="<?php echo e($item->name); ?>" style="width: 48px; height: 48px; border-radius: 50%; object-fit:cover; box-shadow:0 2px 8px rgba(0,158,96,0.10);">
                                <?php else: ?>
                                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; border-radius: 50%;">
                                        <i class="bi bi-person" style="font-size: 22px;"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td style="font-weight:600;"><?php echo e($item->name); ?></td>
                            <td><?php echo e($item->title); ?></td>
                            <td><?php echo e($item->department); ?></td>
                            <td>
                                <?php if($item->pdf_path): ?>
                                    <a href="<?php echo e(asset('storage/' . $item->pdf_path)); ?>" target="_blank" style="color:#009e60; font-weight:600; text-decoration:underline;">Ver PDF</a>
                                <?php endif; ?>
                            </td>
                            <td style="display:flex; gap:0.5em;">
                                <a href="<?php echo e(route('admin.teachers.edit', $item)); ?>" class="btn" style="background: linear-gradient(90deg,#253b7d,#f9d423 90%); color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; min-width:110px; text-align:center; display:flex; align-items:center; gap:0.5em;" title="Editar">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <form action="<?php echo e(route('admin.teachers.destroy', $item)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn" style="background: #e74c3c; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; min-width:110px; text-align:center; display:flex; align-items:center; gap:0.5em;" title="Eliminar" onclick="return confirm('¿Estás seguro de que quieres eliminar a este docente?');">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <!-- Paginación -->
        <div class="d-flex justify-content-center mt-4">
            <?php echo e($items->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ists\resources\views/admin/teachers/index.blade.php ENDPATH**/ ?>