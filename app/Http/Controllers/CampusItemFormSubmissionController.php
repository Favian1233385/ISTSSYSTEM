<?php
namespace App\Http\Controllers;

use App\Models\CampusItemContent;
use App\Models\CampusItemFormSubmission;
use Illuminate\Http\Request;

class CampusItemFormSubmissionController extends Controller
{
    // Mostrar envíos en el panel admin
    public function index(CampusItemContent $content)
    {
        $submissions = $content->formSubmissions()->latest()->get();
        return view('admin.campus-item-contents.submissions', compact('content', 'submissions'));
    }

    // Recibir y guardar envío desde el formulario público
    public function store(Request $request, CampusItemContent $content)
    {
        $validated = $request->validate([
            'nombres' => 'required|string|max:255',
            'cedula' => 'required|string|max:20',
            'carrera' => 'required|string|max:255',
            'ciclo' => 'required|string|max:50',
            'nivel' => 'required|string|max:50',
            'institucion' => 'required|string|max:255',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $pdfPath = null;
        if ($request->hasFile('pdf_file')) {
            $pdf = $request->file('pdf_file');
            $filename = uniqid() . '-' . preg_replace("/[^A-Za-z0-9_.-]/", "", $pdf->getClientOriginalName());
            $destination = public_path('uploads/form_pdfs');
            if (!is_dir($destination)) {
                mkdir($destination, 0755, true);
            }
            $pdf->move($destination, $filename);
            $pdfPath = '/uploads/form_pdfs/' . $filename;
        }

        CampusItemFormSubmission::create(array_merge($validated, [
            'campus_item_content_id' => $content->id,
            'pdf_path' => $pdfPath,
        ]));

        return back()->with('success', 'Formulario enviado correctamente.');
    }
}
