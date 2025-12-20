<div style="min-height: 100vh; width: 100vw; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #1766a3 0%, #10b981 100%);">
  <form method="POST" action="<?php echo e(route('login')); ?>" autocomplete="off" style="background: #fff; border-radius: 18px; box-shadow: 0 8px 32px rgba(23,102,163,0.18); padding: 2.7rem 2.2rem 2.2rem 2.2rem; max-width: 410px; width: 100%; display: flex; flex-direction: column; align-items: center;">
    <?php echo csrf_field(); ?>

    <div style="margin-bottom: 1.2rem;">
      <a href="/">
        <img src="<?php echo e(asset('assets/images/logoists.png')); ?>" alt="Logo ISTS" style="height: 64px;">
      </a>
    </div>
    <div style="font-size: 1.6rem; font-weight: 800; color: #1766a3; margin-bottom: 0.2rem; text-align: center; display: flex; align-items: center; gap: 0.5rem;">
      <span style="font-size:1.5rem;">🔒</span> Acceso ISTS
    </div>
    <div style="font-size: 1.08rem; color: #10b981; margin-bottom: 1.5rem; text-align: center; font-weight: 500;">Sistema de Gestión - Instituto Superior Tecnológico Sucúa</div>

    <?php if($errors->any()): ?>
      <div style="background: #fee; color: #c33; border-left: 4px solid #c33; padding: 10px 14px; border-radius: 6px; margin-bottom: 1rem; font-size: 0.98rem; width: 100%;">
        <ul style="margin:0; padding-left: 1.1em;">
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    <?php endif; ?>

    <div style="margin-bottom: 1.2rem; width: 100%;">
      <label for="email" style="font-weight: 600; color: #1766a3; display: flex; align-items: center; gap: 0.4rem; margin-bottom: 0.2rem;">
        <span style="font-size:1.1rem;">📧</span> Correo Institucional
      </label>
      <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus placeholder="usuario@istsucua.edu.ec" autocomplete="username" style="width: 100%; padding: 1rem 1.1rem; border: 1.5px solid #e0e7ef; border-radius: 8px; margin-top: 0.3rem; background: #f8fafc; font-size: 1.08rem; outline: none; box-shadow: none;">
    </div>

    <div style="margin-bottom: 1.2rem; width: 100%;">
      <label for="password" style="font-weight: 600; color: #1766a3; display: flex; align-items: center; gap: 0.4rem; margin-bottom: 0.2rem;">
        <span style="font-size:1.1rem;">🔑</span> Contraseña
      </label>
      <input id="password" type="password" name="password" required placeholder="Ingresa tu contraseña" autocomplete="current-password" style="width: 100%; padding: 1rem 1.1rem; border: 1.5px solid #e0e7ef; border-radius: 8px; margin-top: 0.3rem; background: #f8fafc; font-size: 1.08rem; outline: none; box-shadow: none;">
    </div>

    <div style="display: flex; align-items: center; margin-bottom: 1.1rem; width: 100%;">
      <input id="remember_me" type="checkbox" name="remember" style="margin-right: 0.5rem;">
      <label for="remember_me" style="font-size: 0.97rem; color: #1766a3;">Recordarme</label>
    </div>

    <button type="submit" style="width: 100%; background: linear-gradient(90deg, #1766a3 0%, #10b981 100%); color: #fff; font-weight: 700; border: none; border-radius: 8px; padding: 1rem 0; font-size: 1.12rem; cursor: pointer; margin-bottom: 0.7rem; letter-spacing: 1px; transition: background 0.2s;">INGRESAR</button>

    <?php if(Route::has('password.request')): ?>
      <a href="<?php echo e(route('password.request')); ?>" style="display: block; text-align: right; color: #10b981; font-size: 0.97rem; text-decoration: none; margin-bottom: 0.5rem;">¿Olvidaste tu contraseña?</a>
    <?php endif; ?>
    <div style="margin-top: 1.5rem; text-align: center; font-size: 0.97rem; color: #1766a3; opacity: 0.7;">
      Acceso restringido solo para usuarios institucionales
    </div>
  </form>
</div>
<?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/auth/login.blade.php ENDPATH**/ ?>