<?php
// Ruta pública para enviar mensajes al chatbot
use App\Http\Controllers\ChatbotController as PublicChatbotController;
use App\Http\Controllers\Admin\ChatbotController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
Route::post('/chatbot/send', [PublicChatbotController::class, 'send'])->name('chatbot.send');

// Ruta para crear docentes desde la gestión de Acerca (si se requiere fuera del resource)
// Route::get('/admin/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
// ...existing code...

// Ruta pública para sección de visitar por slug
Route::get('/visitar/{slug}', [PublicController::class, 'showVisitSection'])->name('visitar.section');
use App\Http\Controllers\Admin\InscripcionAdminController;
// Inscripciones admin
Route::middleware(["auth", "is_admin"])
    ->get("/admin/inscripciones", [InscripcionAdminController::class, "index"])
    ->name("admin.inscripciones.index");
use App\Http\Controllers\InscripcionController;
// Inscripción a cursos de educación continua
Route::get("/inscripcion/{programa}", [
    InscripcionController::class,
    "create",
])->name("inscripcion.create");
// Redirección para login admin
Route::get("/admin/login", function () {
    return redirect("/login");
});
// ...existing code...
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\QAController;
use App\Http\Controllers\LeadershipController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CampusItemController;
use App\Http\Controllers\AcademicSectionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\AutoridadController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\PublicEventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Public routes
Route::get("/", [PublicController::class, "home"])->name("home");
Route::get("/ajax/content/mision-vision", [
    PublicController::class,
    "getMisionVisionAjax",
])->name("ajax.mision-vision");

// Página principal de transparencia con jerarquía correcta
Route::get("/transparency", [
    PublicController::class,
    "showTransparency",
])->name("transparency.index");

// Detalle de reglamento o subreglamento
Route::get("/transparency/{slug}", [
    PublicController::class,
    "transparencyShow",
])->name("transparency.show");
Route::get("/carrera/{slug}", [PublicController::class, "showCareer"])->name(
    "career.show",
);
Route::get("/contenido/{slug}", [PublicController::class, "showContent"])->name(
    "content.show",
);
Route::get("/educacion-continua/{slug}", [
    PublicController::class,
    "showAcademicSection",
])->name("academic-section.show");
Route::get("/academicos", [PublicController::class, "academicos"])->name(
    "academicos",
);
Route::get("/about", function () {
    return view("public.about");
})->name("about");
Route::get("/contact", function () {
    return view("public.contact");
})->name("contact");


Route::get("/tramites", [PublicController::class, "tramites"])->name(
    "tramites",
);

// Nuevas rutas para el menú dinámico
Route::get("/campus", function () {
    return view("public.campus");
})->name("campus");
Route::get('/campus/{slug}', [PublicController::class, 'showCampusItem'])->name('campus.item');
Route::get("/visitar", function () {
    return view("public.visitar");
})->name("visitar");
Route::get("/acerca", function () {
    return view("public.acerca");
})->name("acerca");
Route::get("/noticias", function () {
    $news = \App\Models\News::where("status", "published")
        ->orderBy("created_at", "desc")
        ->paginate(10);
    return view("public.news.index", compact("news"));
})->name("noticias");


// Ruta pública para ver una noticia individual por slug
Route::get('/noticias/{slug}', function($slug) {
    $news = \App\Models\News::where('slug', $slug)->where('status', 'published')->firstOrFail();
    return view('public.news.show', ['news' => $news]);
})->name('noticias.show');

// Ruta pública para Planta Docente
Route::get("/planta-docente", [
    PublicController::class,
    "showPlantaDocente",
])->name("planta-docente");

// Ruta pública para Autoridades
Route::get("/autoridades", [PublicController::class, "showAutoridades"])->name(
    "autoridades",
);

// Ruta pública para el detalle de una autoridad individual por slug
Route::get("/autoridades/{slug}", [
    PublicController::class,
    "showAutoridadDetail",
])->name("autoridades.show");

// Rutas públicas de eventos
Route::get('/eventos', [PublicEventController::class, 'index'])->name('public.events.index');
Route::get('/eventos/{id}', [PublicEventController::class, 'show'])->name('public.events.show');
Route::get('/eventos/calendario', [PublicEventController::class, 'calendar'])->name('public.events.calendar');

// Admin routes
Route::prefix("admin")
    ->middleware(["auth", "is_admin"])
    ->group(function () {
        Route::get("/dashboard", [AdminController::class, "dashboard"])->name(
            "admin.dashboard",
        );

        // Contents management
        Route::resource("contents", ContentController::class, [
            "as" => "admin",
        ]);
        Route::get("/transparency", [ContentController::class, "index"])
            ->defaults("category", "transparency")
            ->name("admin.transparency.index");
        Route::get("/tramites", [ContentController::class, "index"])
            ->defaults("category", "tramites")
            ->name("admin.tramites.index");
        Route::get("/contents/rector", [
            ContentController::class,
            "rector",
        ])->name("admin.contents.rector.index");

        // News management (Gaceta del ISTS)
        Route::get('/news', [\App\Http\Controllers\Admin\NewsController::class, 'index'])->name('admin.news.index');
        Route::get('/news/create', [\App\Http\Controllers\Admin\NewsController::class, 'create'])->name('admin.news.create');
        Route::post('/news', [\App\Http\Controllers\Admin\NewsController::class, 'store'])->name('admin.news.store');
        Route::get('/news/{news}/edit', [\App\Http\Controllers\Admin\NewsController::class, 'edit'])->name('admin.news.edit');
        Route::put('/news/{news}', [\App\Http\Controllers\Admin\NewsController::class, 'update'])->name('admin.news.update');
        Route::delete('/news/{news}', [\App\Http\Controllers\Admin\NewsController::class, 'destroy'])->name('admin.news.destroy');

        // Q&A management
        Route::resource("qas", QAController::class, ["as" => "admin"]);

        // Updates management
        Route::resource('updates', App\Http\Controllers\Admin\UpdateController::class, [
            'as' => 'admin'
        ]);

        // Leadership management
        Route::resource("leadership", LeadershipController::class, [
            "as" => "admin",
        ]);

        // Teachers management
        Route::resource("teachers", TeacherController::class, [
            "as" => "admin",
        ]);

        // Timeline eliminado y reemplazado por gestión de noticias oficiales (news)

        // Visit sections management (corregido)
        Route::resource("visit-sections", \App\Http\Controllers\Admin\VisitSectionController::class, [
            "as" => "admin",
        ]);

        // Campus items
        Route::resource("campus-items", CampusItemController::class, [
            "as" => "admin",
        ]);
        
        // Campus item contents (nested resource)
        Route::resource("campus-items.contents", \App\Http\Controllers\CampusItemContentController::class, [
            "as" => "admin",
            "except" => ["show"],
        ]);

        // Academic sections
        Route::resource("academic-sections", AcademicSectionController::class, [
            "as" => "admin",
        ]);

        // Careers
        Route::resource("careers", CareerController::class, [
            "as" => "admin",
        ]);

        // Autoridades management
        Route::resource("autoridades", AutoridadController::class, [
            "as" => "admin",
            "parameters" => ["autoridades" => "autoridad"],
        ]);

        // Menu items management
        Route::resource("menu-items", MenuItemController::class, [
            "as" => "admin",
        ]);

        // Route for exporting inscriptions
        Route::get("inscripciones/export", [
            InscripcionAdminController::class,
            "export",
        ])->name("admin.inscripciones.export");

        // Users management
        Route::resource("users", UserController::class, ["as" => "admin"]);

        // Settings management
        Route::get("/settings", [SettingController::class, "index"])->name(
            "admin.settings.index",
        );
        Route::post("/settings", [SettingController::class, "update"])->name(
            "admin.settings.update",
        );
        Route::get("/settings/biblioteca", [
            SettingController::class,
            "biblioteca",
        ])->name("admin.settings.biblioteca");
        Route::post("/settings/biblioteca", [
            SettingController::class,
            "updateBiblioteca",
        ])->name("admin.settings.updateBiblioteca");
        Route::get("/settings/graduados", [
            SettingController::class,
            "graduados",
        ])->name("admin.settings.graduados");
        Route::post("/settings/graduados", [
            SettingController::class,
            "updateGraduados",
        ])->name("admin.settings.updateGraduados");

        // Chatbot management
        Route::get("/chatbot", [ChatbotController::class, "index"])->name(
            "admin.chatbot.index",
        );
        Route::get("/chatbot/{id}", [ChatbotController::class, "show"])->name(
            "admin.chatbot.show",
        );
        Route::delete("/chatbot/{id}", [
            ChatbotController::class,
            "destroy",
        ])->name("admin.chatbot.destroy");
        Route::delete("/chatbot/clear", [
            ChatbotController::class,
            "clear",
        ])->name("admin.chatbot.clear");

        // Profile management
        Route::get("/profile", [ProfileController::class, "edit"])->name(
            "admin.profile",
        );
        Route::put("/profile", [ProfileController::class, "update"])->name(
            "admin.profile.update",
        );

        // Additional admin routes
        Route::get("/createContent", [
            AdminController::class,
            "createContent",
        ])->name("admin.createContent");
        Route::get("/createNews", [AdminController::class, "createNews"])->name(
            "admin.createNews",
        );

        // Carrusel (Hero Slides) management
        Route::resource('hero-slides', HeroSlideController::class, ['as' => 'admin']);

        // Calendario Académico
        Route::resource('academic-calendar', App\Http\Controllers\Admin\AcademicCalendarController::class, ['as' => 'admin']);

        // Índice A-Z (Personas y Áreas/Servicios)
        Route::get('/az-index', [\App\Http\Controllers\Admin\AZIndexController::class, 'index'])->name('admin.azindex.index');

        // Chatbot settings management
        Route::get('/chatbot-settings', [\App\Http\Controllers\Admin\ChatbotSettingController::class, 'edit'])->name('admin.chatbot-settings.edit');
        Route::put('/chatbot-settings', [\App\Http\Controllers\Admin\ChatbotSettingController::class, 'update'])->name('admin.chatbot-settings.update');
        Route::post('/qas/clear-history', [\App\Http\Controllers\QAController::class, 'clearHistory'])->name('admin.qas.clearHistory');
    });

// Auth routes (assuming using Laravel's default)

require __DIR__ . "/auth.php";
require __DIR__ . "/admin_about.php";
require __DIR__ . "/admin_academics.php";
require __DIR__.'/admin_events.php';

// Rutas públicas agregadas para el footer
Route::get('/carreras', function () {
    return view('public.carreras');
})->name('carreras');
Route::get('/actualizaciones', function () {
    return view('public.actualizaciones');
})->name('actualizaciones');
