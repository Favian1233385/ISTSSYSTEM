<?php
namespace App\Http\Controllers;

use App\Models\CampusItem;
use App\Models\CampusItemContent;
use Illuminate\Http\Request;

class CampusItemContentController extends Controller
{
    public function index(CampusItem $campusItem)
    {
        $contents = $campusItem->contents()->orderBy('date', 'desc')->get();
        return view('admin.campus-item-contents.list', compact('campusItem', 'contents'));
    }
    public function create(CampusItem $campusItem)
    {
        return view('admin.campus-item-contents.create', compact('campusItem'));
    }

    public function store(Request $request, CampusItem $campusItem)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'nullable|date',
            'description' => 'nullable|string',
            'external_url' => 'nullable|string|max:255',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'contact_name' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'form_html' => 'nullable|string',
            'is_active' => 'boolean',
        ]);


        $pdfUrl = null;
        if ($request->hasFile('pdf_file')) {
            $pdf = $request->file('pdf_file');
            $filename = uniqid() . '-' . preg_replace("/[^A-Za-z0-9_.-]/", "", $pdf->getClientOriginalName());
            $destination = public_path('uploads/pdfs');
            if (!is_dir($destination)) {
                mkdir($destination, 0755, true);
            }
            $pdf->move($destination, $filename);
            $pdfUrl = '/uploads/pdfs/' . $filename;
        }

        $imagePath = null;
        if ($request->hasFile('image_file')) {
            $image = $request->file('image_file');
            $filename = uniqid() . '-' . preg_replace("/[^A-Za-z0-9_.-]/", "", $image->getClientOriginalName());
            $destination = public_path('uploads/images');
            if (!is_dir($destination)) {
                mkdir($destination, 0755, true);
            }
            $image->move($destination, $filename);
            $imagePath = '/uploads/images/' . $filename;
        }

        $videoPath = null;
        if ($request->hasFile('video_file')) {
            $video = $request->file('video_file');
            $filename = uniqid() . '-' . preg_replace("/[^A-Za-z0-9_.-]/", "", $video->getClientOriginalName());
            $destination = public_path('uploads/videos');
            if (!is_dir($destination)) {
                mkdir($destination, 0755, true);
            }
            $video->move($destination, $filename);
            $videoPath = '/uploads/videos/' . $filename;
        }

        $campusItem->contents()->create(array_merge($validated, [
            'pdf_url' => $pdfUrl,
            'image_url' => $request->input('image_url'),
            'image_path' => $imagePath,
            'video_url' => $request->input('video_url'),
            'video_path' => $videoPath,
        ]));

        return redirect()->route('admin.campus-items.edit', $campusItem)
            ->with('success', 'Contenido creado exitosamente.');
    }
}
