<?php
/**
 * Script to set admin password for admin@example.com
 * Run: php scripts/set_admin_password.php
 */
$projectRoot = dirname(__DIR__);
require $projectRoot . '/vendor/autoload.php';
$app = require $projectRoot . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Nueva contraseña generada (seguirá saliendo en la salida para que la copies)
$newPassword = 'X9f$3kLp#Q2vZ8rT6h@1';

$user = User::where('email', 'admin@example.com')->first();
if (! $user) {
    echo "Usuario admin@example.com no encontrado.\n";
    exit(1);
}

$user->password = Hash::make($newPassword);
$user->save();

echo "Contraseña actualizada con éxito.\n";
echo "Email: admin@example.com\n";
echo "Nueva contraseña: {$newPassword}\n";

// opcion: mostrar aviso para cambiar la contraseña en producción
echo "(Cambia esta contraseña inmediatamente en entorno real).\n";
