

<?php $__env->startSection('title', 'Mensajes del Chatbot'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">💬 Mensajes del Chatbot</h1>
            </div>
        </div>
    </div>

    <!-- Estadísticas -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-primary">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Mensajes</h5>
                    <p class="display-4"><?php echo e($stats['total']); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-success">
                <div class="card-body text-center">
                    <h5 class="card-title">Hoy</h5>
                    <p class="display-4"><?php echo e($stats['today']); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-info">
                <div class="card-body text-center">
                    <h5 class="card-title">Esta Semana</h5>
                    <p class="display-4"><?php echo e($stats['week']); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-warning">
                <div class="card-body text-center">
                    <h5 class="card-title">Sesiones</h5>
                    <p class="display-4"><?php echo e($stats['sessions']); ?></p>
                </div>
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

    <!-- Filtros -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Filtros de Búsqueda</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="<?php echo e(route('admin.chatbot.index')); ?>" class="row g-3">
                <div class="col-md-3">
                    <label for="session_id" class="form-label">ID de Sesión</label>
                    <input type="text" class="form-control" id="session_id" name="session_id" 
                           value="<?php echo e(request('session_id')); ?>" placeholder="Buscar por sesión">
                </div>
                <div class="col-md-2">
                    <label for="date_from" class="form-label">Desde</label>
                    <input type="date" class="form-control" id="date_from" name="date_from" 
                           value="<?php echo e(request('date_from')); ?>">
                </div>
                <div class="col-md-2">
                    <label for="date_to" class="form-label">Hasta</label>
                    <input type="date" class="form-control" id="date_to" name="date_to" 
                           value="<?php echo e(request('date_to')); ?>">
                </div>
                <div class="col-md-2">
                    <label for="sentiment" class="form-label">Sentimiento</label>
                    <select class="form-control" id="sentiment" name="sentiment">
                        <option value="">Todos</option>
                        <option value="positive" <?php echo e(request('sentiment') == 'positive' ? 'selected' : ''); ?>>Positivo</option>
                        <option value="neutral" <?php echo e(request('sentiment') == 'neutral' ? 'selected' : ''); ?>>Neutral</option>
                        <option value="negative" <?php echo e(request('sentiment') == 'negative' ? 'selected' : ''); ?>>Negativo</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="unanswered" class="form-label">¿Sin respuesta?</label>
                    <select class="form-control" id="unanswered" name="unanswered">
                        <option value="">Todas</option>
                        <option value="1" <?php echo e(request('unanswered') === '1' ? 'selected' : ''); ?>>Solo sin respuesta</option>
                        <option value="0" <?php echo e(request('unanswered') === '0' ? 'selected' : ''); ?>>Solo con respuesta</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary">🔍 Filtrar</button>
                    <a href="<?php echo e(route('admin.chatbot.index')); ?>" class="btn btn-secondary">🔄 Limpiar</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla de mensajes -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Historial de Conversaciones</h5>
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#clearModal">
                🗑️ Limpiar Antiguos
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sesión</th>
                            <th>Mensaje Usuario</th>
                            <th>Respuesta Bot</th>
                            <th>Sentimiento</th>
                            <th>Sin respuesta</th>
                            <th>IP</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($message->id); ?></td>
                            <td>
                                <small class="text-muted"><?php echo e(Str::limit($message->session_id, 15)); ?></small>
                            </td>
                            <td><?php echo e(Str::limit($message->user_message, 50)); ?></td>
                            <td><?php echo e(Str::limit($message->bot_response, 50)); ?></td>
                            <td>
                                <?php if($message->sentiment == 'positive'): ?>
                                    <span class="badge bg-success">😊 Positivo</span>
                                <?php elseif($message->sentiment == 'negative'): ?>
                                    <span class="badge bg-danger">😞 Negativo</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">😐 Neutral</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($message->unanswered): ?>
                                    <span class="badge bg-warning text-dark">Sin respuesta</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Respondida</span>
                                <?php endif; ?>
                            </td>
                            <td><small><?php echo e($message->ip_address); ?></small></td>
                            <td>
                                <small><?php echo e($message->created_at->format('d/m/Y H:i')); ?></small>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="<?php echo e(route('admin.chatbot.show', $message->id)); ?>" 
                                       class="btn btn-info" title="Ver detalles">
                                        👁️
                                    </a>
                                    <form action="<?php echo e(route('admin.chatbot.destroy', $message->id)); ?>" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('¿Está seguro de eliminar este mensaje?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger" title="Eliminar">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <p class="text-muted mb-0">No hay mensajes registrados</p>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <?php echo e($messages->links()); ?>

            </div>
        </div>
    </div>
</div>

<!-- Modal para limpiar mensajes antiguos -->
<div class="modal fade" id="clearModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Limpiar Mensajes Antiguos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?php echo e(route('admin.chatbot.clear')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="days" class="form-label">Eliminar mensajes anteriores a:</label>
                        <select class="form-control" id="days" name="days" required>
                            <option value="7">7 días</option>
                            <option value="30">30 días</option>
                            <option value="60">60 días</option>
                            <option value="90">90 días</option>
                            <option value="180">180 días</option>
                        </select>
                    </div>
                    <div class="alert alert-warning">
                        <strong>⚠️ Advertencia:</strong> Esta acción no se puede deshacer.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Limpiar Mensajes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/chatbot/index.blade.php ENDPATH**/ ?>