<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ListTransparenciaContents extends Command
{
    protected $signature = 'list:transparencia-contents';
    protected $description = 'Lista todos los contenidos de transparencia con su título y parent_id';

    public function handle()
    {
        $items = DB::table('contents')
            ->where('category', 'transparency')
            ->select('id', 'title', 'parent_id')
            ->orderBy('parent_id')
            ->orderBy('title')
            ->get();

        $this->info("ID | parent_id | Título");
        foreach ($items as $item) {
            $this->line("{$item->id} | " . ($item->parent_id ?? 'NULL') . " | {$item->title}");
        }
    }
}
