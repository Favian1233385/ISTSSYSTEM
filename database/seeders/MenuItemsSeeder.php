<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Limpiar la tabla para evitar duplicados
        \App\Models\MenuItem::truncate();

        \App\Models\MenuItem::create(['title' => 'ACADÉMICOS', 'url' => '#', 'order' => 1]);
        \App\Models\MenuItem::create(['title' => 'CAMPUS', 'url' => '/campus', 'order' => 2]);
        \App\Models\MenuItem::create(['title' => 'TRANSPARENCIA', 'url' => '#', 'order' => 3]);
        \App\Models\MenuItem::create(['title' => 'VISITAR', 'url' => '/visitar', 'order' => 4]);
        \App\Models\MenuItem::create(['title' => 'ACERCA', 'url' => '/acerca', 'order' => 5]);
        \App\Models\MenuItem::create(['title' => 'NOTICIAS', 'url' => '/noticias', 'order' => 6]);
        \App\Models\MenuItem::create(['title' => 'TRÁMITES', 'url' => '#', 'order' => 7]);

        // Subitems para CAMPUS
        $campus = \App\Models\MenuItem::where('title', 'CAMPUS')->first();
        \App\Models\MenuItem::create(['title' => 'Instalaciones', 'url' => '/campus/instalaciones', 'parent_id' => $campus->id, 'order' => 1]);
        \App\Models\MenuItem::create(['title' => 'Servicios', 'url' => '/campus/servicios', 'parent_id' => $campus->id, 'order' => 2]);

        // Subitems para VISITAR
        $visitar = \App\Models\MenuItem::where('title', 'VISITAR')->first();
        \App\Models\MenuItem::create(['title' => 'Visitar ISTS', 'url' => '/visitar', 'parent_id' => $visitar->id, 'order' => 1]);

        // Subitems para ACERCA
        $acerca = \App\Models\MenuItem::where('title', 'ACERCA')->first();
        \App\Models\MenuItem::create(['title' => 'Sobre el ISTS', 'url' => '/acerca', 'parent_id' => $acerca->id, 'order' => 1]);

        // Subitems para NOTICIAS
        $noticias = \App\Models\MenuItem::where('title', 'NOTICIAS')->first();
        \App\Models\MenuItem::create(['title' => 'Todas las Noticias', 'url' => '/noticias', 'parent_id' => $noticias->id, 'order' => 1]);
    }
}
