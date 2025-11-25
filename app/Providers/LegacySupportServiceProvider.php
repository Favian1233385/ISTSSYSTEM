<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LegacySupportServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        // Incluir archivos legacy que proporcionan Model, Database, Controller, etc.
        $paths = [
            base_path('app/core/Model.php'),
            base_path('app/core/Database.php'),
            base_path('app/core/Controller.php'),
            base_path('app/core/App.php'),
        ];

        foreach ($paths as $file) {
            if (file_exists($file)) {
                require_once $file;
            }
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // nada por ahora
    }
}
