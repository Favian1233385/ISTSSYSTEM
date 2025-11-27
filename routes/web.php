// Ruta pública para secciones de Acerca dinámicas
Route::get('/acerca/{id}', function($id) {
    $section = \App\Models\About::findOrFail($id);
    return view('public.about_section', compact('section'));
})->name('about.section');

<?php

// Redirección para login admin
Route::get('/admin/login', function() {
    return redirect('/login');
});

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\QAController;
use App\Http\Controllers\HeroSlidesController;
use App\Http\Controllers\LeadershipController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CampusItemController;
use App\Http\Controllers\AcademicSectionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\Admin\CareerController;

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
Route::get("/transparency/{slug}", [
    PublicController::class,
    "transparencyShow",
])->name("transparency.show");
Route::get("/carrera/{slug}", [PublicController::class, "showCareer"])->name("career.show");
Route::get("/contenido/{slug}", [PublicController::class, "showContent"])->name("content.show");
Route::get("/educacion-continua/{slug}", [PublicController::class, "showAcademicSection"])->name("academic-section.show");
Route::get("/academicos", [PublicController::class, "academicos"])->name("academicos");
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
Route::get("/campus/instalaciones", function () {
    return view("public.campus-item", ['item' => 'instalaciones']);
})->name("campus.instalaciones");
Route::get("/campus/servicios", function () {
    return view("public.campus-item", ['item' => 'servicios']);
})->name("campus.servicios");
Route::get("/visitar", function () {
    return view("public.visitar");
})->name("visitar");
Route::get("/acerca", function () {
    return view("public.acerca");
})->name("acerca");
Route::get("/noticias", function () {
    $news = \App\Models\News::where('status', 'published')->orderBy('created_at', 'desc')->paginate(10);
    return view("public.news.index", compact('news'));
})->name("noticias");

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

        // News management
        Route::get("/news", [ContentController::class, "index"])
            ->defaults("category", "news")
            ->name("admin.news.index");
        Route::get("/news/create", [ContentController::class, "create"])
            ->defaults("category", "news")
            ->name("admin.news.create");
        Route::post("/news", [ContentController::class, "store"])->name(
            "admin.news.store",
        );
        Route::get("/news/{content}", [ContentController::class, "show"])
            ->defaults("category", "news")
            ->name("admin.news.show");
        Route::get("/news/{content}/edit", [ContentController::class, "edit"])
            ->defaults("category", "news")
            ->name("admin.news.edit");
        Route::put("/news/{content}", [
            ContentController::class,
            "update",
        ])->name("admin.news.update");
        Route::delete("/news/{content}", [
            ContentController::class,
            "destroy",
        ])->name("admin.news.destroy");

        // Q&A management
        Route::resource("qas", QAController::class, ["as" => "admin"]);

        // Updates management
        Route::get("/updates", [ContentController::class, "index"])
            ->defaults("category", "updates")
            ->name("admin.updates.index");

        // Hero slides management
        Route::resource("hero-slides", HeroSlidesController::class, [
            "as" => "admin",
        ]);

        // Leadership management
        Route::resource("leadership", LeadershipController::class, [
            "as" => "admin",
        ]);

        // Teachers management
        Route::resource("teachers", TeacherController::class, [
            "as" => "admin",
        ]);

        // Timeline management
        Route::get("/timeline", [ContentController::class, "index"])
            ->defaults("category", "timeline")
            ->name("admin.timeline.index");

        // Visit sections management
        Route::get("/visit-sections", [ContentController::class, "index"])
            ->defaults("category", "visit-sections")
            ->name("admin.visit-sections.index");
        Route::get("/visit-sections/{content}/edit", [
            ContentController::class,
            "edit",
        ])
            ->defaults("category", "visit-sections")
            ->name("admin.visit-sections.edit");

        // Campus items
        Route::resource("campus-items", CampusItemController::class, [
            "as" => "admin",
        ]);

        // Academic sections
        Route::resource("academic-sections", AcademicSectionController::class, [
            "as" => "admin",
        ]);

        // Careers
        Route::resource("careers", CareerController::class, [
            "as" => "admin",
        ]);

        // Menu items management
        Route::resource("menu-items", MenuItemController::class, [
            "as" => "admin",
        ]);

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
    });

// Auth routes (assuming using Laravel's default)

require __DIR__ . "/auth.php";
require __DIR__ . "/admin_about.php";
