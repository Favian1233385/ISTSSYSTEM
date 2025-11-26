<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\AcademicSection;
use App\Models\Career;
use Illuminate\Support\Facades\DB;

class HeaderComposer
{
    public function compose(View $view)
    {
        $academicSections = AcademicSection::where("is_active", true)
            ->with([
                "careers" => function ($query) {
                    $query->where("is_active", true)->ordered();
                },
            ])
            ->ordered()
            ->get();

        $allCareers = Career::where("is_active", true)->ordered()->get();

        $courses = DB::table("contents")
            ->where("category", "course")
            ->where("status", "published")
            ->get();

        $transparencyContents = DB::table("contents")
            ->where("category", "transparency")
            ->whereNull("parent_id")
            ->where("status", "published")
            ->orderBy("created_at", "desc")
            ->get()
            ->map(function ($item) {
                $item->children = DB::table("contents")
                    ->where("parent_id", $item->id)
                    ->where("status", "published")
                    ->orderBy("created_at", "desc")
                    ->get()
                    ->map(function ($child) {
                        return (array) $child;
                    })
                    ->toArray();
                return (array) $item;
            })
            ->toArray();

        $tramites = DB::table("contents")
            ->where("category", "tramites")
            ->whereNull("parent_id")
            ->where("status", "published")
            ->orderBy("created_at", "desc")
            ->get()
            ->map(function ($item) {
                return (array) $item;
            })
            ->toArray();

        $view->with(
            compact(
                "academicSections",
                "allCareers",
                "courses",
                "transparencyContents",
                "tramites",
            ),
        );
    }
}
