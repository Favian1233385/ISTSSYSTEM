<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

\App\Models\MenuItem::where('title', 'ACADÉMICOS')->update(['title' => 'ACADEMICOS']);
echo 'Updated';
?>