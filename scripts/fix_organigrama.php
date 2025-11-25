<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== CONTENIDO ORGANIGRAMA ===\n\n";

$organigrama = DB::table('contents')->where('slug', 'organigrama')->first();

if ($organigrama) {
    echo "ID: {$organigrama->id}\n";
    echo "Slug: {$organigrama->slug}\n";
    echo "Title: {$organigrama->title}\n";
    echo "Status: " . ($organigrama->status ?? 'NULL') . "\n";
    echo "Created by: {$organigrama->created_by}\n";
    
    echo "\n🔄 Actualizando status a 'published'...\n";
    DB::table('contents')->where('id', $organigrama->id)->update(['status' => 'published']);
    echo "✅ Status actualizado a 'published'\n";
} else {
    echo "❌ No se encontró el organigrama\n";
}
