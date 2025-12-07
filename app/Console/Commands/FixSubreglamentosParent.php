<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixSubreglamentosParent extends Command
{
    protected $signature = 'fix:subreglamentos-parent';
    protected $description = 'Asigna correctamente el parent_id de los subreglamentos bajo Reglamentos internos';

    public function handle()
    {
        // Títulos de subreglamentos a corregir
        $subreglamentos = [
            'Reglamento de Higiene y Seguridad',
            'Estatuto del Instituto',
            'Reglamento de Relaciones Interinstitucionales',
        ];

        // Buscar el ID de Reglamentos internos
        $reglamentoInterno = DB::table('contents')
            ->where('category', 'transparency')
            ->where('title', 'Reglamentos internos')
            ->whereNull('parent_id')
            ->first();

        if (!$reglamentoInterno) {
            $this->error('No se encontró "Reglamentos internos" como sección principal.');
            return 1;
        }

        $parentId = $reglamentoInterno->id;

        // Actualizar parent_id de los subreglamentos
        $updated = DB::table('contents')
            ->where('category', 'transparency')
            ->whereIn('title', $subreglamentos)
            ->update(['parent_id' => $parentId]);

        $this->info("Subreglamentos actualizados: $updated");
        return 0;
    }
}
