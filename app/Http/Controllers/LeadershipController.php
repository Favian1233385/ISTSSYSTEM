<?php

namespace App\Http\Controllers;

use App\Models\LeadershipTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LeadershipController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        $this->middleware("is_admin");
    }

    public function index()
    {
        $teamMembers = LeadershipTeam::orderBy("order")->paginate(10);
        return view("admin.leadership.index", [
            "title" => "Gestión de Equipo - ISTS Admin",
            "items" => $teamMembers,
        ]);
    }

    public function create()
    {
        return view("admin.leadership.create", [
            "title" => "Añadir Miembro - ISTS Admin",
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "position" => "required|string|max:255",
            "bio" => "nullable|string",
            "image" => "nullable|image|max:5120",
            "order" => "nullable|integer",
        ]);

        $imagePath = null;
        if ($request->hasFile("image")) {
            $imagePath = $request->file("image")->store("leadership", "public");
        }

        LeadershipTeam::create([
            "name" => $request->name,
            "position" => $request->position,
            "bio" => $request->bio,
            "image_path" => $imagePath,
            "order" => $request->order ?? 0,
        ]);

        return redirect()
            ->route("admin.leadership.index")
            ->with("success", "Miembro del equipo añadido exitosamente.");
    }

    public function edit(LeadershipTeam $leadershipTeam)
    {
        return view("admin.leadership.edit", [
            "title" => "Editar Miembro - ISTS Admin",
            "item" => $leadershipTeam,
        ]);
    }

    public function update(Request $request, LeadershipTeam $leadershipTeam)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "position" => "required|string|max:255",
            "bio" => "nullable|string",
            "image" => "nullable|image|max:5120",
            "order" => "nullable|integer",
        ]);

        $imagePath = $leadershipTeam->image_path;
        if ($request->hasFile("image")) {
            if ($imagePath) {
                Storage::disk("public")->delete($imagePath);
            }
            $imagePath = $request->file("image")->store("leadership", "public");
        }

        $leadershipTeam->update([
            "name" => $request->name,
            "position" => $request->position,
            "bio" => $request->bio,
            "image_path" => $imagePath,
            "order" => $request->order ?? 0,
        ]);

        return redirect()
            ->route("admin.leadership.index")
            ->with("success", "Miembro del equipo actualizado exitosamente.");
    }

    public function destroy(LeadershipTeam $leadershipTeam)
    {
        if ($leadershipTeam->image_path) {
            Storage::disk("public")->delete($leadershipTeam->image_path);
        }
        $leadershipTeam->delete();
        return redirect()
            ->route("admin.leadership.index")
            ->with("success", "Miembro del equipo eliminado exitosamente.");
    }
}
