<?php $__env->startSection('content'); ?>
<div class="admin-content">
    <div class="dashboard-header">
        <h1>👥 Gestión de Usuarios</h1>
        <p>Administra los usuarios del sistema.</p>
        <a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-primary">➕ Crear Usuario</a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table" style="min-width: 900px;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Último Login</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($item->id); ?></td>
                        <td><?php echo e($item->name ?? $item->username); ?></td>
                        <td><?php echo e($item->email); ?></td>
                        <td>
                            <span class="badge" style="background: 
                                <?php if($item->role === 'admin'): ?> var(--admin-primary)
                                <?php elseif($item->role === 'editor'): ?> var(--admin-secondary)
                                <?php else: ?> var(--admin-gray) <?php endif; ?>;
                                color: white;">
                                <?php echo e(ucfirst($item->role)); ?>

                            </span>
                        </td>
                        <td>
                            <span class="badge" style="background: <?php echo e($item->status === 'active' ? 'var(--admin-primary)' : '#EF4444'); ?>; color: white;">
                                <?php echo e($item->status === 'active' ? 'Activo' : 'Inactivo'); ?>

                            </span>
                        </td>
                        <td>
                            <?php if($item->last_login): ?>
                                <?php echo e(\Carbon\Carbon::parse($item->last_login)->format('d/m/Y H:i')); ?>

                            <?php else: ?>
                                Nunca
                            <?php endif; ?>
                        </td>
                        <td class="actions">
                            <div class="admin-action-buttons" style="display: flex; gap: 0.5em; justify-content: center; align-items: center;">
                                <a href="<?php echo e(route('admin.users.edit', $item->id)); ?>" class="btn btn-sm btn-edit">Editar</a>
                                <form action="<?php echo e(route('admin.users.destroy', $item->id)); ?>" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este usuario?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="no-items">No hay usuarios registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if($items->lastPage() > 1): ?>
        <nav class="pagination">
            <ul>
                <?php if($items->currentPage() > 1): ?>
                    <li><a href="?page=<?php echo e($items->currentPage() - 1); ?>">Anterior</a></li>
                <?php endif; ?>
                <?php for($i = 1; $i <= $items->lastPage(); $i++): ?>
                    <li>
                        <a href="?page=<?php echo e($i); ?>" class="<?php echo e($i == $items->currentPage() ? 'active' : ''); ?>">
                            <?php echo e($i); ?>

                        </a>
                    </li>
                <?php endfor; ?>
                <?php if($items->currentPage() < $items->lastPage()): ?>
                    <li><a href="?page=<?php echo e($items->currentPage() + 1); ?>">Siguiente</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/crud/users/list.blade.php ENDPATH**/ ?>