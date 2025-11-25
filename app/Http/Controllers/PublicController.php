<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AcademicSection;

class PublicController extends Controller
{
    public function home()
    {
        // Get misionVision content
        $misionVision = DB::table("contents")
            ->where("slug", "mision-y-vision")
            ->where("status", "published")
            ->first();

        // Get transparency contents for header dropdown
        $transparencyContents = DB::table("contents")
            ->where("category", "transparency")
            ->whereNull("parent_id")
            ->where("status", "published")
            ->orderBy("created_at", "desc")
            ->get()
            ->map(function ($item) {
                return (array) $item;
            })
            ->toArray();

        // Get Academic Sections with their active careers for the header
        $academicSections = AcademicSection::where("is_active", true)
            ->with([
                "careers" => function ($query) {
                    $query->where("is_active", true)->ordered();
                },
            ])
            ->ordered()
            ->get();

        return view(
            "public.home",
            compact("misionVision", "transparencyContents", "academicSections"),
        );
    }

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

        // Get children if any
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
        $career = \App\Models\Career::where('slug', $slug)->where('is_active', true)->first();

        if (!$career) {
            abort(404);
        }

        return view('public.career_detail', compact('career'));
    }

    public function showAcademicSection($slug)
    {
        $section = \App\Models\AcademicSection::where('slug', $slug)->where('is_active', true)->first();

        if (!$section) {
            abort(404);
        }

        return view('public.academic_section_detail', compact('section'));
    }

    public function academicos()
    {
        $careers = \App\Models\Career::active()->ordered()->get();
        $sections = \App\Models\AcademicSection::active()->ordered()->get();

        return view('public.academicos', compact('careers', 'sections'));
    }
}
