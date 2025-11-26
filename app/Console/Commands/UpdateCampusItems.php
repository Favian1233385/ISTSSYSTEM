<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CampusItem;

class UpdateCampusItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'campus:update-items';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualizar y recargar los elementos del campus';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Limpiando la tabla CampusItem...');
        CampusItem::truncate();

        $this->info('Insertando nuevos datos...');
        $items = [
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
        ];

        foreach ($items as $item) {
            CampusItem::create($item);
        }

        $this->info('Elementos del campus actualizados correctamente.');

        return Command::SUCCESS;
    }
}
