<?php
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    $users = DB::table('users')->select('id','name','email','role')->get();
    if ($users->isEmpty()) {
        echo "No users found\n";
    } else {
        foreach ($users as $u) {
            echo "{$u->id}\t{$u->name}\t{$u->email}\t{$u->role}\n";
        }
    }
} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage() . PHP_EOL;
}
