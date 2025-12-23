

<?php $__env->startSection('content'); ?>
<div class="card" style="border-radius: 18px; box-shadow: 0 2px 16px rgba(0,158,96,0.10); margin-top: 2.5rem;">
    <div class="card-body p-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold mb-1" style="font-size:2.3rem; color:#00796b; letter-spacing:-1px;">
                <span style="font-size:2.2rem;">📄</span> Gestión de Documentos
            </h1>
            <p class="text-muted mb-3">Administra los contenidos del sitio.</p>
            <a href="<?php echo e(route('admin.contents.create')); ?>" class="btn" style="background: linear-gradient(90deg,#009e60,#f9d423 90%); color: #fff; font-weight:600; box-shadow:0 2px 8px rgba(0,158,96,0.15); border-radius: 8px; padding: 0.75rem 1.5rem; font-size:1.1rem; transition:box-shadow .2s;">Crear Sección</a>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="card-table" style="background: #fff; border-radius: 18px; box-shadow: 0 4px 24px 0 rgba(37,99,235,0.10); padding: 2.2rem 2.2rem 1.5rem 2.2rem; max-width: 1100px; margin: 2.5rem auto 0 auto;">
            <table style="width: 100%; border-collapse: separate; border-spacing: 0;">
                <thead style="background: #f3f6fd; color: #2563eb; font-weight: 700; font-size: 1.08rem;">
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Documentos</th>
                        <th>Sitios Externos</th>
                        <th>Estado</th>
                        <th>Creado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($is_hierarchical) && $is_hierarchical): ?>
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($parent["id"]); ?></td>
                                <td><strong><?php echo e($parent["title"]); ?></strong></td>
                                <td>
                                    <?php if(!empty($parent['file_url'])): ?>
                                        <?php $files = json_decode($parent['file_url'], true); ?>
                                        <?php if(is_array($files)): ?>
                                            <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="<?php echo e(asset($file)); ?>" target="_blank">Ver Archivo</a><br>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php elseif(filter_var($parent['file_url'], FILTER_VALIDATE_URL)): ?>
                                            <a href="<?php echo e($parent['file_url']); ?>" target="_blank">Ver Archivo Externo</a>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(!empty($parent['is_external']) && !empty($parent['url'])): ?>
                                        <a href="<?php echo e($parent['url']); ?>" target="_blank"><?php echo e($parent['url']); ?></a>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td><span class="badge" style="background:<?php echo e($parent['status']==='published' ? '#009e60' : '#f9d423'); ?>;color:#fff; font-weight:600; border-radius:6px; padding:0.4em 1em; font-size:0.98em;"><?php echo e($parent["status"]); ?></span></td>
                                <td><?php echo e(\Carbon\Carbon::parse($parent["created_at"])->format('d/m/Y')); ?></td>
                                <td class="actions" style="display:flex; gap:0.5em;">
                                    <a href="<?php echo e(route('admin.contents.edit', $parent['id'])); ?>" class="btn btn-edit-uniform" style="background: #253b7d; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; box-shadow:0 2px 8px rgba(37,59,125,0.10); min-width:120px; text-align:center;">Editar</a>
                                    <form action="<?php echo e(route('admin.contents.destroy', $parent['id'])); ?>" method="POST" style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn" style="background: #e74c3c; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; box-shadow:0 2px 8px rgba(231,76,60,0.10);">Eliminar</button>
                                    </form>
                                    <?php if($parent['category'] !== 'tramites'): ?>
                                        <a href="<?php echo e(route('admin.contents.create', ['parent_id' => $parent['id']])); ?>" class="btn" style="background: #009e60; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; box-shadow:0 2px 8px rgba(0,158,96,0.10);">Agregar Subreglamento</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php if($parent['category'] !== 'tramites' && !empty($parent['children'])): ?>
                            <?php $__currentLoopData = $parent['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr style="background-color: #f9f9f9;">
                                    <td><?php echo e($child["id"]); ?></td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;└─ <?php echo e($child["title"]); ?> <small>(Sub-reglamento)</small></td>
                                    <td>
                                        <?php if(!empty($child['file_url'])): ?>
                                            <?php $files = json_decode($child['file_url'], true); ?>
                                            <?php if(is_array($files)): ?>
                                                <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(asset($file)); ?>" target="_blank">Ver Archivo</a><br>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php elseif(filter_var($child['file_url'], FILTER_VALIDATE_URL)): ?>
                                                <a href="<?php echo e($child['file_url']); ?>" target="_blank">Ver Archivo Externo</a>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if(!empty($child['is_external']) && !empty($child['url'])): ?>
                                            <a href="<?php echo e($child['url']); ?>" target="_blank"><?php echo e($child['url']); ?></a>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                    <td><span class="badge" style="background:<?php echo e($child['status']==='published' ? '#009e60' : '#f9d423'); ?>;color:#fff; font-weight:600; border-radius:6px; padding:0.4em 1em; font-size:0.98em;"><?php echo e($child["status"]); ?></span></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($child["created_at"])->format('d/m/Y')); ?></td>
                                    <td class="actions" style="display:flex; gap:0.5em;">
                                        <a href="<?php echo e(route('admin.contents.edit', $child['id'])); ?>" class="btn btn-edit-uniform" style="background: #253b7d; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; box-shadow:0 2px 8px rgba(37,59,125,0.10); min-width:120px; text-align:center;">Editar</a>
                                        <form action="<?php echo e(route('admin.contents.destroy', $child['id'])); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn" style="background: #e74c3c; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; box-shadow:0 2px 8px rgba(231,76,60,0.10);">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item["id"]); ?></td>
                                <td><?php echo e($item["title"]); ?></td>
                                <td>-</td>
                                <td>-</td>
                                <td><span class="badge" style="background:<?php echo e($item['status']==='published' ? '#009e60' : '#f9d423'); ?>;color:#fff; font-weight:600; border-radius:6px; padding:0.4em 1em; font-size:0.98em;"><?php echo e($item["status"]); ?></span></td>
                                <td><?php echo e(\Carbon\Carbon::parse($item["created_at"])->format('d/m/Y')); ?></td>
                                <td class="actions" style="display:flex; gap:0.5em;">
                                    <a href="<?php echo e(route('admin.contents.edit', $item['id'])); ?>" class="btn btn-edit-uniform" style="background: #253b7d; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; box-shadow:0 2px 8px rgba(37,59,125,0.10); min-width:120px; text-align:center;">Editar</a>
                                    <form action="<?php echo e(route('admin.contents.destroy', $item['id'])); ?>" method="POST" style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn" style="background: #e74c3c; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; box-shadow:0 2px 8px rgba(231,76,60,0.10);">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <style>
            .btn-edit-uniform {
                min-width: 120px !important;
                min-height: 44px !important;
                height: 44px !important;
                text-align: center;
                display: flex;
                align-items: center;
                justify-content: center;
                padding-top: 0 !important;
                padding-bottom: 0 !important;
            }
        </style>
        <div class="d-flex justify-content-center mt-4">
            <?php echo e($items->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/crud/contents/list.blade.php ENDPATH**/ ?>