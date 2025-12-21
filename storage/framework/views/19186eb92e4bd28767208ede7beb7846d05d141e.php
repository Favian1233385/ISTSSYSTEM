

<?php $__env->startSection('title', 'Contactos del Chatbot'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h2 class="mb-4">Contactos del Chatbot</h2>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Fecha de Registro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($contact->id); ?></td>
                            <td><?php echo e($contact->nombre); ?></td>
                            <td><?php echo e($contact->telefono); ?></td>
                            <td><?php echo e($contact->created_at->format('d/m/Y H:i')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center">No hay contactos registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="mt-3">
                <?php echo e($contacts->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/chatbot/contacts.blade.php ENDPATH**/ ?>