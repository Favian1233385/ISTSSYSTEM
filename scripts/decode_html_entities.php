<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== DECODIFICANDO ENTIDADES HTML ===\n\n";

$contents = DB::table('contents')->get(['id', 'slug', 'description', 'content']);

foreach ($contents as $content) {
    $needsUpdate = false;
    $updates = [];
    
    // Decodificar descripción si tiene entidades HTML
    if ($content->description && strpos($content->description, '&') !== false) {
        $decodedDesc = html_entity_decode($content->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        if ($decodedDesc !== $content->description) {
            $updates['description'] = $decodedDesc;
            $needsUpdate = true;
            echo "📝 Contenido ID {$content->id} ({$content->slug})\n";
            echo "   Descripción: " . substr($content->description, 0, 80) . "...\n";
            echo "   → " . substr($decodedDesc, 0, 80) . "...\n\n";
        }
    }
    
    // Decodificar contenido si tiene entidades HTML
    if ($content->content && strpos($content->content, '&') !== false) {
        $decodedContent = html_entity_decode($content->content, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        if ($decodedContent !== $content->content) {
            $updates['content'] = $decodedContent;
            $needsUpdate = true;
            if (!isset($updates['description'])) {
                echo "📝 Contenido ID {$content->id} ({$content->slug})\n";
            }
            echo "   Contenido tiene entidades HTML escapadas\n\n";
        }
    }
    
    if ($needsUpdate) {
        DB::table('contents')->where('id', $content->id)->update($updates);
        echo "   ✅ Actualizado\n\n";
    }
}

echo "=== Proceso completado ===\n";
