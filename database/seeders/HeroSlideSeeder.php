<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\HeroSlide::create([
            'title' => 'Instituto Superior Tecnológico Sucúa',
            'subtitle' => 'Fortaleciendo la Educación Superior de Tercer Nivel en Morona Santiago',
            'image_path' => 'hero-slides/default-hero.jpg',
            'link' => null,
            'sort_order' => 0,
            'is_active' => true
        ]);

        $this->command->info('Hero slides de ejemplo creados exitosamente.');
    }
}
