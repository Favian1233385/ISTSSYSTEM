<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TimelineEvent;

class TimelineEventSeeder extends Seeder
{
    public function run()
    {
        $events = [
            [ 'year' => 2000, 'title' => 'Fundación', 'description' => 'Fundación del ISTS.' ],
            [ 'year' => 2005, 'title' => 'Nuevas Carreras', 'description' => 'Apertura de nuevas carreras tecnológicas.' ],
            [ 'year' => 2015, 'title' => 'Reconocimiento', 'description' => 'Reconocimiento nacional por excelencia académica.' ],
            [ 'year' => 2022, 'title' => 'Educación Continua', 'description' => 'Inicio de programas de educación continua.' ],
            [ 'year' => 2025, 'title' => 'Alianzas', 'description' => 'Actualización de planes de estudio y alianzas estratégicas.' ],
            [ 'year' => 2030, 'title' => 'Nuevo Campus', 'description' => 'Inauguración del nuevo campus y modernización curricular orientada a IA y sostenibilidad.' ],
        ];

        foreach ($events as $i => $e) {
            TimelineEvent::updateOrCreate(
                ['year' => $e['year'], 'title' => $e['title']],
                ['description' => $e['description'], 'order' => $i]
            );
        }
    }
}
