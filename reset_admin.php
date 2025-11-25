<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Resetear contraseña del admin
$user = User::where('email', 'admin@example.com')->first();

if ($user) {
    $user->password = Hash::make('password');
    $user->save();
    echo "✓ Contraseña actualizada para admin@example.com\n";
    echo "  Email: admin@example.com\n";
    echo "  Password: password\n";
} else {
    echo "✗ No se encontró el usuario admin@example.com\n";
}
