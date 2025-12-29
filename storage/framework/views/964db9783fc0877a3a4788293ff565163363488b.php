<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('resources/js/admin_chatbot_contacts.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<div class="card">
    <div class="card-body">
        <h2 class="mb-4" style="display:flex;align-items:center;gap:8px;font-size:1.5rem;">
            <span style="font-size:1.7rem;">📇</span> Contactos del Chatbot
        </h2>
        <div style="margin:1.2rem 0 2.2rem 0;">
            <!-- Fila de filtros -->
            <form method="GET" action="<?php echo e(route('admin.chatbot.contacts')); ?>" class="d-flex flex-row flex-wrap align-items-end" style="gap:1rem; margin-bottom:0;">
                <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o teléfono" value="<?php echo e(request('search')); ?>" style="max-width:210px; min-width:180px; height:42px; padding:0.375rem 0.75rem;">
                <select name="carrera" class="form-select" style="max-width:180px; min-width:150px; height:42px; padding:0.375rem 0.75rem;">
                    <option value="">-- Todas las carreras --</option>
                    <?php $__currentLoopData = \App\Models\ChatbotContact::select('carrera')->distinct()->whereNotNull('carrera')->where('carrera', '!=', '')->orderBy('carrera')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($c->carrera); ?>" <?php if(request('carrera') == $c->carrera): ?> selected <?php endif; ?>><?php echo e($c->carrera); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <button type="submit" class="btn btn-primary" style="height:42px; padding:0.375rem 1.25rem;">Filtrar</button>
                <button type="button" class="btn btn-secondary" style="height:42px; padding:0.375rem 1.25rem;" onclick="this.form.reset(); window.location.href=window.location.pathname;">Limpiar</button>
            </form>
            <!-- Fila de acciones -->
            <div class="d-flex flex-row justify-content-between align-items-center mt-2" style="gap:1rem; width:100%;">
                 <a href="<?php echo e(route('admin.chatbot.contacts.export')); ?>" class="btn btn-success btn-lg fw-semibold m-0">⬇️ Descargar Excel</a>
                 <button type="button" class="btn btn-danger btn-lg fw-semibold m-0" onclick="if(confirm('¿Estás seguro de eliminar todos los contactos? Esta acción no se puede deshacer.')){ document.getElementById('delete-all-contacts-form').submit(); }">🗑️ Eliminar todos los contactos</button>
            </div>
            <form id="delete-all-contacts-form" action="<?php echo e(route('admin.chatbot.contacts.destroyAll')); ?>" method="POST" style="display:none;">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
            </form>
        </div>
        <div class="table-responsive" style="margin-top:1.5rem;">
            <table class="table table-bordered table-hover align-middle" style="background:#fff; border-radius:12px; overflow:hidden;">
                <thead class="table-light">
                    <tr style="background:#f3f6fd; color:#2563eb;">
                        <th style="width:60px;">#</th>
                        <th style="min-width:180px;">Nombre</th>
                        <th style="min-width:150px;">Teléfono</th>
                        <th style="min-width:180px;">Carrera</th>
                        <th style="min-width:180px;">Fecha de Registro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td style="text-align:center;font-weight:600;"><?php echo e($contact->id); ?></td>
                            <td style="text-transform:capitalize;">👤 <?php echo e(ucwords(strtolower($contact->nombre))); ?></td>
                            <td><span class="badge bg-success" style="font-size:1rem;letter-spacing:1px;"><?php echo e($contact->telefono); ?></span></td>
                            <td><?php echo e($contact->carrera); ?></td>
                            <td><span style="color:#1976d2;font-weight:500;"><?php echo e($contact->created_at->format('d/m/Y H:i')); ?></span></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center">No hay contactos registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <?php echo e($contacts->links()); ?>

        </div>
    </div>
</div>
<?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/chatbot/contacts_block.blade.php ENDPATH**/ ?>