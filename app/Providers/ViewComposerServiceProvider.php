<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Compartir configuraciones globales con todas las vistas
        view()->composer('*', function ($view) {
            // Cargar URLs de settings para el header
            $bibliotecaUrl = \DB::table('settings')->where('key', 'biblioteca_url')->value('value');
            $graduadosUrl = \DB::table('settings')->where('key', 'seguimiento_graduados_url')->value('value');
            
            $view->with('bibliotecaUrl', $bibliotecaUrl);
            $view->with('graduadosUrl', $graduadosUrl);
        });
        
        // Compartir datos específicos para el dashboard de admin
        view()->composer('admin.dashboard', function ($view) {
            $careers = \App\Models\Career::orderBy('sort_order')->get();
            $sections = \App\Models\AcademicSection::orderBy('sort_order')->get();
            $campusItems = \App\Models\CampusItem::orderBy('order')->get();
            $leaders = \App\Models\LeadershipTeam::orderBy('order')->get();
            $teachers = \App\Models\Teacher::orderBy('name')->get();
            $slides = \App\Models\HeroSlide::orderBy('sort_order')->get();
            
            // Visit Sections para la sección Visitar
            $visitSections = \App\Models\VisitSection::ordered()->get()->keyBy('slug');
            
            $contents = \DB::table('contents')->orderBy('created_at','desc')->limit(10)->get();
            $totalContents = \DB::table('contents')->count();
            
            // Counts para cards del dashboard
            $qasCount = \DB::table('q_a_s')->count();
            $updatesActiveCount = \DB::table('updates')->where('is_active', true)->count();
            
            // Contenidos específicos por slug
            $historiaContent = \DB::table('contents')->where('slug', 'linea-de-tiempo')->first();
            $misionVisionContent = \DB::table('contents')->where('slug', 'mision-y-vision')->first();
            $organigramaContent = \DB::table('contents')->where('slug', 'organigrama')->first();
            
            $asesoriaJuridicaContent = \DB::table('contents')->where('slug', 'asesoria-juridica')->first();
            $bienestarContent = \DB::table('contents')->where('slug', 'bienestar-institucional')->first();
            $planificacionContent = \DB::table('contents')->where('slug', 'planificacion-estrategica')->first();
            $relacionesContent = \DB::table('contents')->where('slug', 'relaciones-internacionales')->first();
            $secretariaContent = \DB::table('contents')->where('slug', 'secretaria-general')->first();
            $seguridadContent = \DB::table('contents')->where('slug', 'seguridad-salud-ocupacional')->first();
            $talentoContent = \DB::table('contents')->where('slug', 'talento-humano')->first();
            $tecnologiasContent = \DB::table('contents')->where('slug', 'tecnologias-informacion')->first();
            $unidadAdminContent = \DB::table('contents')->where('slug', 'unidad-administrativa')->first();
            $comunicacionContent = \DB::table('contents')->where('slug', 'unidad-comunicacion')->first();
            
            $view->with(compact(
                'careers', 'sections', 'campusItems', 'leaders', 'teachers', 'slides',
                'contents', 'totalContents', 'qasCount', 'updatesActiveCount', 'visitSections',
                'historiaContent', 'misionVisionContent', 'organigramaContent',
                'asesoriaJuridicaContent', 'bienestarContent', 'planificacionContent',
                'relacionesContent', 'secretariaContent', 'seguridadContent',
                'talentoContent', 'tecnologiasContent', 'unidadAdminContent', 'comunicacionContent'
            ));
        });
    }
}
