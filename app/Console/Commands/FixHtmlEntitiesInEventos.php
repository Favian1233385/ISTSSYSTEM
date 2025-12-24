<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixHtmlEntitiesInEventos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:html-entities-eventos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convierte entidades HTML a caracteres reales en la tabla eventos (tildes, ñ, etc.)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $eventos = DB::table('events')->get();
        $total = 0;
        foreach ($eventos as $evento) {
            $description = html_entity_decode($evento->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            if ($description !== $evento->description) {
                DB::table('events')->where('id', $evento->id)->update([
                    'description' => $description
                ]);
                $total++;
            }
        }
        $this->info("Se corrigieron $total descripciones de eventos.");
    }
}
