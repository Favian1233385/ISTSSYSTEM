<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\CampusItem;

// Limpiar y recargar datos
CampusItem::truncate();

$items = [
    // Coordinaciones
    [
        'title' => 'Coordinaciones de Carrera',
        'description' => 'Coordinación académica de las diferentes carreras tecnológicas del instituto',
        'url' => '/campus/coordinaciones-carrera',
        'content' => '<h2>Coordinaciones de Carrera</h2><p>Las coordinaciones de carrera son responsables de la gestión académica y administrativa de cada programa tecnológico del ISTS.</p>',
        'is_external' => false,
        'category' => 'coordinaciones',
        'order' => 1,
        'is_active' => true,
    ],
    [
        'title' => 'Investigación, Desarrollo Tecnológico e Innovación',
        'description' => 'Fomento de la investigación y el desarrollo tecnológico en el instituto',
        'url' => '/campus/investigacion',
        'content' => '<h2>Investigación y Desarrollo</h2><p>Área dedicada al fomento de la investigación científica y desarrollo tecnológico.</p>',
        'is_external' => false,
        'category' => 'coordinaciones',
        'order' => 2,
        'is_active' => true,
    ],
    [
        'title' => 'Vinculación con la Sociedad',
        'description' => 'Proyectos y actividades de vinculación con la comunidad',
        'url' => '/campus/vinculacion',
        'content' => '<h2>Vinculación con la Sociedad</h2><p>Gestión de proyectos de vinculación que conectan al instituto con la comunidad.</p>',
        'is_external' => false,
        'category' => 'coordinaciones',
        'order' => 3,
        'is_active' => true,
    ],
    
    // Servicios
    [
        'title' => 'Centro de Formación Integral y de Servicios Especializados',
        'description' => 'Servicios de formación complementaria y especializada',
        'url' => '/campus/formacion-integral',
        'content' => '<h2>Centro de Formación Integral</h2><p>Ofrecemos servicios de formación complementaria para el desarrollo integral de nuestros estudiantes.</p>',
        'is_external' => false,
        'category' => 'servicios',
        'order' => 1,
        'is_active' => true,
    ],
    [
        'title' => 'Biblioteca',
        'description' => 'Acceso a la biblioteca digital institucional',
        'url' => 'https://biblioteca.ists.edu.ec',
        'content' => null,
        'is_external' => true,
        'category' => 'servicios',
        'order' => 2,
        'is_active' => true,
    ],
    [
        'title' => 'Aseguramiento de la Calidad',
        'description' => 'Gestión de la calidad educativa y acreditación',
        'url' => '/campus/aseguramiento-calidad',
        'content' => '<h2>Aseguramiento de la Calidad</h2><p>Coordinación de procesos de evaluación, acreditación y mejora continua institucional.</p>',
        'is_external' => false,
        'category' => 'servicios',
        'order' => 3,
        'is_active' => true,
    ],
    [
        'title' => 'Centro de Idiomas',
        'description' => 'Cursos y certificaciones de idiomas extranjeros',
        'url' => '/campus/centro-idiomas',
        'content' => '<h2>Centro de Idiomas</h2><p>Ofrecemos cursos de inglés y otros idiomas para complementar la formación profesional.</p>',
        'is_external' => false,
        'category' => 'servicios',
        'order' => 4,
        'is_active' => true,
    ],
];

foreach ($items as $item) {
    CampusItem::create($item);
}

echo "✓ Items del campus actualizados exitosamente!\n";
echo "  Total de items: " . count($items) . "\n";
echo "  Biblioteca marcada como enlace externo\n";
