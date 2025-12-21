<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AcademicSection;
use App\Models\Autoridad;

class PublicController extends Controller
{
    /**
     * Muestra el detalle de un reglamento o subreglamento de transparencia.
     */
    public function transparencyShow($slug)
    {
        $content = DB::table("contents")
            ->where("slug", $slug)
            ->where("category", "transparency")
            ->where("status", "published")
            ->first();

        if (!$content) {
            abort(404);
        }

        $content = (array) $content;

        // Obtener hijos si existen
        $children = DB::table("contents")
            ->where("parent_id", $content["id"])
            ->where("status", "published")
            ->orderBy("created_at", "desc")
            ->get()
            ->map(function ($item) {
                return (array) $item;
            })
            ->toArray();

        return view("public.content_detail", compact("content", "children"));
    }

    /**
     * Muestra el índice A-Z institucional (personas, carreras, servicios, etc.)
     */
    public function azIndex()
    {

        // Personas: solo activas, no admins ni pruebas, deduplicadas
        $personas = \App\Models\User::query()
            ->whereNotIn('role', ['admin', 'superadmin'])
            ->where(function($q) {
                $q->whereNull('email')
                  ->orWhere('email', 'not like', '%@example.com%');
            });
        return view('public.azindex', compact('personas', 'carreras', 'secciones', 'servicios'));
    }

    /**
     * Muestra una sección de visitar por slug.
     */
    public function showVisitSection($slug)
    {
        $section = \App\Models\VisitSection::where('slug', $slug)->where('is_active', true)->first();
        if (!$section) {
            abort(404);
        }
        return view('public.visit-section', compact('section'));
    }
    /**
     * Muestra la lista de docentes (planta docente).
     *
     * @return \Illuminate\Http\Response
     */
    public function showPlantaDocente()
    {
        $teachers = \App\Models\Teacher::orderBy("order")->get();
        return view("public.planta-docente", compact("teachers"));
    }
    public function home()
    {
        // Get misionVision content
        $misionVision = DB::table("contents")
            ->where("slug", "mision-y-vision")
            ->where("status", "published")
            ->first();

        // Get active rector
        $rector = \App\Models\Rector::where("is_active", true)
            ->orderByDesc("id")
            ->first();

        // Get latest updates (máximo 3)
        $updates = \App\Models\Update::recent(3)->get();

        // Slides activos para el carrusel
        $heroSlides = \App\Models\HeroSlide::where('is_active', true)
            ->whereNotNull('image_path')
            ->where('image_path', '!=', '')
            ->orderBy('sort_order')
            ->get();

        // Campus items y sus contenidos activos
        $campusItems = \App\Models\CampusItem::active()
            ->orderBy('order')
            ->with(['contents' => function($q) {
                $q->where('is_active', true)->orderBy('date', 'desc');
            }])
            ->get();

        // Vida Estudiantil administrable
        $vidaEstudiantilItems = \App\Models\CampusItem::active()
            ->byCategory('vida_estudiantil')
            ->orderBy('order')
            ->with(['contents' => function($q) {
                $q->where('is_active', true)->orderBy('date', 'desc');
            }])
            ->get();

        $careers = \App\Models\Career::active()->ordered()->get();

        // --- GACETA: Unificar noticias y eventos pasados como noticias ---
        $news = \App\Models\News::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get()
            ->map(function($item) {
                $item->is_event = false;
                $item->date_for_sort = $item->published_at;
                return $item;
            });

        $pastEvents = \App\Models\Event::where('status', 'published')
            ->whereDate('date', '<', now())
            ->orderBy('date', 'desc')
            ->take(3)
            ->get()
            ->map(function($item) {
                $item->is_event = true;
                $item->date_for_sort = $item->date;
                $item->summary = $item->description;
                $item->images = $item->images()->pluck('image_path')->toArray();
                $item->slug = 'evento-'.$item->id;
                return $item;
            });

        // Unir y ordenar por fecha (desc)
        $gacetaList = $news->concat($pastEvents)->sortByDesc('date_for_sort')->take(3)->values();

        return view(
            "public.home",
            compact(
                "misionVision",
                "rector",
                "updates",
                "campusItems",
                "vidaEstudiantilItems",
                "heroSlides",
                "careers",
                "gacetaList"
            ),
        );
    }


    /**
     * Muestra la página principal de transparencia con jerarquía correcta.
     */
    public function showTransparency()
    {
        $contents = DB::table("contents")
            ->where("category", "transparency")
            ->where("status", "published")
            ->orderBy("parent_id", "asc")
            ->orderBy("created_at", "desc")
            ->get()
            ->map(fn($item) => (array) $item)
            ->toArray();

        // Buscar el ID de 'Reglamentos Internos' (por título o slug)
        $main = null;
        $mainId = null;
        foreach ($contents as $item) {
            if (
                (isset($item['title']) && trim(mb_strtolower($item['title'])) === 'reglamentos internos') ||
                (isset($item['slug']) && trim(mb_strtolower($item['slug'])) === 'reglamentos-internos')
            ) {
                $main = $item;
                $mainId = $item['id'];
                break;
            }
        }

        $children = [];
        if ($main && $mainId) {
            foreach ($contents as $item) {
                if ($item['parent_id'] == $mainId) {
                    $children[] = $item;
                }
            }
            $main['children'] = $children;
        }

        $items = $main ? [$main] : [];

        return view("public.transparency.index", [
            "title" => "Transparencia",
            "items" => $items,
        ]);
    }

    public function getMisionVisionAjax(Request $request)
    {
        $part = $request->query("part", "mision"); // 'mision' or 'vision'

        $misionVision = DB::table("contents")
            ->where("slug", "mision-y-vision")
            ->where("status", "published")
            ->first();

        if (!$misionVision) {
            return response()->json([
                "html" => "<p>Contenido no encontrado.</p>",
            ]);
        }

        $body = $misionVision->content ?? "";

        // Extract HTML for the specific part
        $dom = new \DOMDocument();
        @$dom->loadHTML(
            "<div>" . $body . "</div>",
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD,
        );
        $xpath = new \DOMXPath($dom);

        $headings = $xpath->query("//h1 | //h2 | //h3 | //h4 | //h5 | //h6");
        $sections = [];

        foreach ($headings as $heading) {
            $sections[] = $heading->textContent;
        }

        // Assume first heading is Misión, second is Visión
        $misionHtml = "";
        $visionHtml = "";

        if (count($sections) >= 2) {
            // Split the body by headings
            $parts = preg_split(
                "/(<h[1-6][^>]*>.*?<\/h[1-6]>)/i",
                $body,
                -1,
                PREG_SPLIT_DELIM_CAPTURE,
            );

            $currentSection = "";
            $misionStarted = false;
            $visionStarted = false;

            foreach ($parts as $partItem) {
                if (
                    preg_match(
                        "/<h[1-6][^>]*>(.*?)<\/h[1-6]>/i",
                        $partItem,
                        $matches,
                    )
                ) {
                    $headingText = trim($matches[1]);
                    if (stripos($headingText, "misión") !== false) {
                        $currentSection = "mision";
                        $misionStarted = true;
                        $misionHtml .= $partItem;
                    } elseif (stripos($headingText, "visión") !== false) {
                        $currentSection = "vision";
                        $visionStarted = true;
                        $visionHtml .= $partItem;
                    } else {
                        $currentSection = "";
                    }
                } elseif ($currentSection === "mision") {
                    $misionHtml .= $partItem;
                } elseif ($currentSection === "vision") {
                    $visionHtml .= $partItem;
                }
            }
        } else {
            // Fallback: split in half
            $plain = strip_tags($body);
            $mid = intval(strlen($plain) / 2);
            $pos = strpos($plain, " ", $mid);
            if ($pos === false) {
                $pos = $mid;
            }
            $misionText = substr($plain, 0, $pos);
            $visionText = substr($plain, $pos);

            $misionHtml = "<p>" . nl2br($misionText) . "</p>";
            $visionHtml = "<p>" . nl2br($visionText) . "</p>";
        }

        $html = $part === "mision" ? $misionHtml : $visionHtml;

        return response()->json([
            "html" => $html ?: "<p>Contenido no disponible.</p>",
        ]);
    }

    public function tramites()
    {
        $tramites = DB::table("contents")
            ->where("category", "tramites")
            ->where("status", "published")
            ->orderBy("created_at", "desc")
            ->get()
            ->map(function ($item) {
                return (array) $item;
            })
            ->toArray();

        return view("public.tramites", compact("tramites"));
    }

    public function showCareer($slug)
    {
        $career = \App\Models\Career::where("slug", $slug)
            ->where("is_active", true)
            ->first();

        if (!$career) {
            abort(404);
        }

        return view("public.career_detail", compact("career"));
    }

    public function showContent($slug)
    {
        $content = DB::table("contents")
            ->where("slug", $slug)
            ->where("status", "published")
            ->first();

        if (!$content) {
            abort(404);
        }

        return view("public.content_detail", compact("content"));
    }

    public function showAcademicSection($slug)
    {
        $section = \App\Models\AcademicSection::where("slug", $slug)
            ->where("is_active", true)
            ->with("careers") // Cargar los programas/carreras asociados
            ->first();

        if (!$section) {
            abort(404);
        }

        return view("public.academic_section_detail", compact("section"));
    }

    public function academicos()
    {
        $careers = \App\Models\Career::active()->ordered()->get();
        $courses = DB::table("contents")
            ->where("category", "course")
            ->where("status", "published")
            ->get();

        return view("public.academicos", compact("careers", "courses"));
    }

    /**
     * Muestra la lista de autoridades.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAutoridades()
    {
        $autoridades = Autoridad::orderBy("orden")->get();
        return view("public.autoridades.index", compact("autoridades"));
    }

    /**
     * Muestra los detalles de una autoridad específica por su slug.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function showAutoridadDetail($slug)
    {
        $autoridad = Autoridad::where("slug", $slug)->first();

        if (!$autoridad) {
            abort(404);
        }

        return view("public.autoridades.show", compact("autoridad"));
    }

    /**
     * Muestra la información y contenidos de un campus item por slug.
     */
    public function showCampusItem($slug)
    {
        $item = \App\Models\CampusItem::where('url', '/campus/' . $slug)
            ->with(['contents' => function($q) {
                $q->where('is_active', true)->orderBy('date', 'desc');
            }, 'images'])
            ->first();
        if (!$item) {
            abort(404);
        }
        return view('public.campus-item', compact('item'));
    }

    public function transparencyMenu()
    {
        $contents = DB::table("contents")
            ->where("category", "transparency")
            ->where("status", "published")
            ->orderBy("parent_id", "asc")
            ->orderBy("created_at", "desc")
            ->get()
            ->map(fn($item) => (array) $item)
            ->toArray();

        $parents = [];
        $children = [];
        foreach ($contents as $content) {
            if ($content["parent_id"] === null) {
                $parents[] = $content;
            } else {
                $children[$content["parent_id"]][] = $content;
            }
        }

        foreach ($parents as &$parent) {
            $parent["children"] = $children[$parent["id"]] ?? [];
        }

        return $parents;
    }

    public function headerData()
    {
        $transparencyMenu = $this->transparencyMenu();
        return view('public.partials.header', compact('transparencyMenu'));
    }
}
