<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        $this->middleware("is_admin");
    }

    public function index()
    {
        $teachers = Teacher::orderBy("order")->paginate(10);
        return view("admin.teachers.index", [
            "title" => "Gestión de Planta Docente - ISTS Admin",
            "items" => $teachers,
        ]);
    }

    public function create()
    {
        return view("admin.teachers.create", [
            "title" => "Añadir Docente - ISTS Admin",
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "title" => "nullable|string|max:255",
            "department" => "nullable|string|max:255",
            "bio" => "nullable|string",
            "image" => "nullable|image|max:5120",
            "pdf" => "nullable|mimes:pdf|max:10240", // 10MB Max
            "order" => "nullable|integer",
        ]);

        $imagePath = null;
        if ($request->hasFile("image")) {
            $imagePath = $request->file("image")->store("teachers", "public");
        }

        $pdfPath = null;
        if ($request->hasFile("pdf")) {
            $pdfPath = $request->file("pdf")->store("teachers_pdf", "public");
        }

        Teacher::create([
            // Nombre todo en mayúsculas
            "name" => mb_strtoupper($request->name),
            // Título: primera letra de cada palabra en mayúscula
            "title" => mb_convert_case($request->title, MB_CASE_TITLE, "UTF-8"),
            // Departamento todo en mayúsculas
            "department" => mb_strtoupper($request->department),
            // Biografía: primera letra en mayúscula, resto igual
            "bio" => $request->bio ? mb_strtoupper(mb_substr($request->bio, 0, 1)) . mb_substr($request->bio, 1) : null,
            "image_path" => $imagePath,
            "pdf_path" => $pdfPath,
            "order" => $request->order ?? 0,
        ]);

        return redirect()
            ->route("admin.teachers.index")
            ->with("success", "Docente añadido exitosamente.");
    }

    public function edit(Teacher $teacher)
    {
        return view("admin.teachers.edit", [
            "title" => "Editar Docente - ISTS Admin",
            "item" => $teacher,
        ]);
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "title" => "nullable|string|max:255",
            "department" => "nullable|string|max:255",
            "bio" => "nullable|string",
            "image" => "nullable|image|max:5120",
            "pdf" => "nullable|mimes:pdf|max:10240", // 10MB Max
            "order" => "nullable|integer",
        ]);

        $imagePath = $teacher->image_path;
        if ($request->hasFile("image")) {
            if ($imagePath) {
                Storage::disk("public")->delete($imagePath);
            }
            $imagePath = $request->file("image")->store("teachers", "public");
        }

        $pdfPath = $teacher->pdf_path;
        if ($request->hasFile("pdf")) {
            if ($pdfPath) {
                Storage::disk("public")->delete($pdfPath);
            }
            $pdfPath = $request->file("pdf")->store("teachers_pdf", "public");
        }

        $teacher->update([
            // Nombre todo en mayúsculas
            "name" => mb_strtoupper($request->name),
            // Título: primera letra de cada palabra en mayúscula
            "title" => mb_convert_case($request->title, MB_CASE_TITLE, "UTF-8"),
            // Departamento todo en mayúsculas
            "department" => mb_strtoupper($request->department),
            // Biografía: primera letra en mayúscula, resto igual
            "bio" => $request->bio ? mb_strtoupper(mb_substr($request->bio, 0, 1)) . mb_substr($request->bio, 1) : null,
            "image_path" => $imagePath,
            "pdf_path" => $pdfPath,
            "order" => $request->order ?? 0,
        ]);

        return redirect()
            ->route("admin.teachers.index")
            ->with("success", "Docente actualizado exitosamente.");
    }

    public function destroy(Teacher $teacher)
    {
        if ($teacher->image_path) {
            Storage::disk("public")->delete($teacher->image_path);
        }
        if ($teacher->pdf_path) {
            Storage::disk("public")->delete($teacher->pdf_path);
        }
        $teacher->delete();
        return redirect()
            ->route("admin.teachers.index")
            ->with("success", "Docente eliminado exitosamente.");
    }
}
