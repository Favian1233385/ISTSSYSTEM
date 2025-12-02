<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inscripcion;
use App\Models\AcademicProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InscripcionAdminController extends Controller
{
    public function index(Request $request)
    {
        $programa_id = $request->query("programa_id");
        $query = Inscripcion::with(["programa", "modalidad"]);
        if ($programa_id) {
            $query->where("programa_id", $programa_id);
        }
        $inscripciones = $query->orderByDesc("created_at")->paginate(20);
        $programas = AcademicProgram::orderBy("title")->get();
        return view(
            "admin.inscripciones.index",
            compact("inscripciones", "programas", "programa_id"),
        );
    }
    public function export(Request $request)
    {
        $programa_id = $request->query("programa_id");

        if (!$programa_id) {
            return redirect()
                ->route("admin.inscripciones.index")
                ->with(
                    "error",
                    "Debe seleccionar un programa para exportar inscripciones.",
                );
        }

        $inscripciones = Inscripcion::with(["programa", "modalidad"])
            ->where("programa_id", $programa_id)
            ->orderByDesc("created_at")
            ->get();

        if ($inscripciones->isEmpty()) {
            return redirect()
                ->route("admin.inscripciones.index", [
                    "programa_id" => $programa_id,
                ])
                ->with("error", "No hay inscripciones para este programa.");
        }

        $programaNombre =
            $inscripciones->first()->programa->title ?? "desconocido";
        $fileName =
            "inscripciones_" .
            Str::slug($programaNombre) .
            "_" .
            now()->format("Ymd_His") .
            ".csv";

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function () use ($inscripciones) {
            $file = fopen("php://output", "w");

            // Encabezados del CSV
            fputcsv(
                $file,
                [
                    "ID",
                    "Fecha Inscripción",
                    "Curso",
                    "Modalidad",
                    "Nombre Completo",
                    "Cédula",
                    "Email",
                    "Teléfono",
                    "Especialidad",
                    "Observaciones",
                ],
                ";",
            ); // <-- Añadido el delimitador de punto y coma

            // Datos de las inscripciones
            foreach ($inscripciones as $insc) {
                fputcsv(
                    $file,
                    [
                        $insc->id,
                        $insc->created_at->format("d/m/Y H:i"),
                        $insc->programa->title ?? "-",
                        $insc->modalidad->title ?? "-",
                        $insc->nombre,
                        $insc->cedula,
                        $insc->email,
                        $insc->telefono,
                        $insc->especialidad,
                        $insc->observaciones,
                    ],
                    ";",
                ); // <-- Añadido el delimitador de punto y coma
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
