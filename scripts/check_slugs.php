<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== CONTENIDOS EN LA BASE DE DATOS ===\n\n";

$contents = DB::table('contents')->orderBy('id')->get(['id', 'slug', 'title']);

foreach ($contents as $content) {
    $slugLen = strlen($content->slug);
    $titleLen = strlen($content->title);
    echo "ID: {$content->id}\n";
    echo "  Slug: [{$content->slug}] (length: {$slugLen})\n";
    echo "  Title: [{$content->title}] (length: {$titleLen})\n";
    echo "  Slug bytes: " . bin2hex($content->slug) . "\n\n";
}

echo "\n=== VERIFICANDO SLUG 'organigrama' ===\n";
$organigrama = DB::table('contents')->where('slug', 'organigrama')->first();
if ($organigrama) {
    echo "✅ Encontrado con ID: {$organigrama->id}\n";
} else {
    echo "❌ NO encontrado\n";
}
