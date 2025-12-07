<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanSubreglamentosDuplicates extends Command
{
    protected $signature = 'clean:subreglamentos-duplicates';
    protected $description = 'Elimina subreglamentos duplicados con parent_id NULL en transparencia';

    public function handle()
    {
        $subreglamentos = [
            'Reglamento de Higiene y Seguridad ISTS',
            'ESTATUTO-DEL-INSTITUTO_ISTS',
            'REGLAMENTO-RELACIONES-INTERINSTITUCIONALES_ISTS',
        ];

        $deleted = DB::table('contents')
            ->where('category', 'transparency')
            ->whereNull('parent_id')
            ->whereIn('title', $subreglamentos)
            ->delete();

        $this->info("Registros eliminados: $deleted");
        return 0;
    }
}
