
<form method="POST" action="<?php echo e(route('login')); ?>" class="login-ists-form" autocomplete="off">
    <?php echo csrf_field(); ?>

    <?php if($errors->any()): ?>
        <div class="login-ists-error">
            <ul style="margin:0; padding-left: 1.1em;">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <label for="email">Correo electrónico</label>
    <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus placeholder="usuario@istsucua.edu.ec" autocomplete="username">

    <label for="password">Contraseña</label>
    <input id="password" type="password" name="password" required placeholder="Ingresa tu contraseña" autocomplete="current-password">

    <div class="remember">
        <input id="remember_me" type="checkbox" name="remember">
        <label for="remember_me">Recordarme</label>
    </div>

    <button type="submit" class="login-btn">Ingresar</button>

    <?php if(Route::has('password.request')): ?>
        <a class="forgot" href="<?php echo e(route('password.request')); ?>">¿Olvidaste tu contraseña?</a>
    <?php endif; ?>
</form>
<?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/auth/login.blade.php ENDPATH**/ ?>