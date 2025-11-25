<?php

namespace App\Http\Controllers;

use App\Models\AcademicSection;
use App\Models\Career;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        // Requiere autenticación
        $this->middleware("auth");

        // Comprueba que el usuario tenga rol admin. Ajustar si su modelo usa otra propiedad.
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            if (!$user || ($user->role ?? null) !== "admin") {
                // Redirige a la ruta estándar de login
                return redirect(url("/login"));
            }
            return $next($request);
        });
    }

    public function index()
    {
        // Redirige al dashboard administrativo
        return redirect()->route("admin.dashboard");
    }

    public function dashboard()
    {
        // Nueva lógica limpia para el dashboard académico
        $academicSections = AcademicSection::withCount([
            "careers" => function ($query) {
                $query->where("is_active", true);
            },
        ])
            ->ordered()
            ->get();

        $teachersCount = Teacher::count();

        return view("admin.dashboard", [
            "title" => "Dashboard - ISTS Admin",
            "academicSections" => $academicSections,
            "teachersCount" => $teachersCount,
        ]);
    }

    public function createContent()
    {
        return view("admin.crud.contents.create", [
            "title" => "Crear Contenido - ISTS Admin",
        ]);
    }

    public function createNews()
    {
        return view("admin.crud.news.create", [
            "title" => "Crear Noticia - ISTS Admin",
            "type" => "news",
        ]);
    }

    public function contents()
    {
        return redirect(url("/contents"));
    }

    public function news()
    {
        return redirect(url("/news"));
    }

    public function users()
    {
        return redirect(url("/users"));
    }

    public function settings()
    {
        return view("admin.settings", [
            "title" => "Configuración - ISTS Admin",
        ]);
    }
}
