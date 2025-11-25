<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$contents = DB::table('contents')->get();

foreach ($contents as $content) {
    DB::table('contents')->where('id', $content->id)->update([
        'slug' => trim($content->slug),
        'title' => trim($content->title)
    ]);
}

echo "✅ Limpiados " . $contents->count() . " contenidos\n";
