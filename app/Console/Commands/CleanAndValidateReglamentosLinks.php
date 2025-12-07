<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanAndValidateReglamentosLinks extends Command
{
    protected $signature = 'clean:reglamentos-links';
    protected $description = 'Limpia y valida los enlaces de reglamentos y subreglamentos en transparencia';

    public function handle()
    {
        $items = DB::table('contents')
            ->where('category', 'transparency')
            ->get(['id', 'title', 'file_url', 'external_url']);

        $publicPath = public_path();
        $updated = 0;

        foreach ($items as $item) {
            $fileUrl = $item->file_url;
            $externalUrl = $item->external_url ?? null;
            $needsUpdate = false;

            // Limpiar file_url si es array/JSON o tiene corchetes
            if ($fileUrl && (str_starts_with($fileUrl, '[') || str_starts_with($fileUrl, '{'))) {
                $fileUrl = null;
                $needsUpdate = true;
            }
            // Validar existencia física del archivo PDF
            if ($fileUrl && !file_exists($publicPath . $fileUrl)) {
                $fileUrl = null;
                $needsUpdate = true;
            }
            // Limpiar external_url si no es un enlace válido
            if ($externalUrl && !filter_var($externalUrl, FILTER_VALIDATE_URL)) {
                $externalUrl = null;
                $needsUpdate = true;
            }
            if ($needsUpdate) {
                DB::table('contents')->where('id', $item->id)->update([
                    'file_url' => $fileUrl,
                    'external_url' => $externalUrl,
                ]);
                $updated++;
                $this->line("Actualizado: {$item->title}");
            }
        }
        $this->info("Total de registros corregidos: $updated");
    }
}
