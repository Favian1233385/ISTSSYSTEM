<?php
$projectRoot = dirname(__DIR__);
require $projectRoot . '/vendor/autoload.php';
$app = require $projectRoot . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

$u = User::where('email','admin@example.com')->first();
if ($u) {
    echo "FOUND: {$u->email} (role={$u->role})\n";
} else {
    echo "NOT FOUND\n";
}
