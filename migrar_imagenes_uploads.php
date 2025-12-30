<?php
// Script para migrar imágenes antiguas de public/uploads/images a storage/app/public/uploads/images
define('BASE_PATH', __DIR__);

$publicUploads = BASE_PATH . '/public/uploads/images';
$storageUploads = BASE_PATH . '/storage/app/public/uploads/images';

if (!is_dir($publicUploads)) {
    echo "No existe la carpeta public/uploads/images.\n";
    exit(1);
}
if (!is_dir($storageUploads)) {
    mkdir($storageUploads, 0777, true);
}

$files = scandir($publicUploads);
$count = 0;
foreach ($files as $file) {
    if ($file === '.' || $file === '..') continue;
    $src = $publicUploads . '/' . $file;
    $dst = $storageUploads . '/' . $file;
    if (is_file($src)) {
        if (!file_exists($dst)) {
            if (copy($src, $dst)) {
                echo "Copiado: $file\n";
                $count++;
            } else {
                echo "Error al copiar: $file\n";
            }
        } else {
            echo "Ya existe en destino: $file\n";
        }
    }
}
echo "Total de archivos copiados: $count\n";
