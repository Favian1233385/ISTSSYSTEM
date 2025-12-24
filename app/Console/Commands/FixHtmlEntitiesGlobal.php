<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixHtmlEntitiesGlobal extends Command
{
    protected $signature = 'fix:html-entities-global';
    protected $description = 'Convierte entidades HTML a caracteres reales en todas las tablas y columnas de texto de la base de datos.';

    public function handle()
    {
        $database = DB::getDatabaseName();
        $tables = DB::select('SHOW TABLES');
        $tableKey = 'Tables_in_' . $database;
        $total = 0;
        foreach ($tables as $tableObj) {
            $table = $tableObj->$tableKey;
            $columns = DB::select("SHOW COLUMNS FROM `{$table}`");
            $textColumns = array_filter($columns, function($col) {
                return strpos($col->Type, 'char') !== false || strpos($col->Type, 'text') !== false;
            });
            if (empty($textColumns)) continue;
            $rows = DB::table($table)->get();
            foreach ($rows as $row) {
                $updateData = [];
                foreach ($textColumns as $col) {
                    $colName = $col->Field;
                    $original = $row->$colName;
                    if ($original === null) continue;
                    $decoded = html_entity_decode($original, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                    if ($decoded !== $original) {
                        $updateData[$colName] = $decoded;
                    }
                }
                if (!empty($updateData)) {
                    DB::table($table)->where('id', $row->id)->update($updateData);
                    $total++;
                }
            }
        }
        $this->info("Se corrigieron $total registros en toda la base de datos.");
    }
}
