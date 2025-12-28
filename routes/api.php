<?php
use App\Models\AcademicProgram;
// Endpoint para detalles de un programa (curso) de educación continua
Route::get('/programa/{id}', function ($id) {
    $programa = AcademicProgram::with('modality')->findOrFail($id);
    return response()->json([
        'id' => $programa->id,
        'title' => $programa->title,
        'description' => $programa->description,
        'start_date' => $programa->start_date,
        'end_date' => $programa->end_date,
        'document' => $programa->document ? asset('storage/' . $programa->document) : null,
        'url' => $programa->url,
        'registration_enabled' => $programa->registration_enabled,
        'inscripcion_disponible' => $programa->registration_enabled, // o lógica según fechas
    ]);
});
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QAController;
use App\Http\Controllers\ChatbotContactController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware("auth:sanctum")->get("/user", function (Request $request) {
    return $request->user();
});
Route::post("/chatbot", [QAController::class, "responder"]);
Route::post('/chatbot/contacto', [ChatbotContactController::class, 'store']);

// Endpoint para buscar contacto de chatbot por teléfono
Route::get('/chatbot/contacto/buscar', function (Request $request) {
    $telefono = $request->query('telefono');
    if (!$telefono) {
        return response()->json(['found' => false, 'message' => 'Teléfono requerido'], 400);
    }
    $contact = \App\Models\ChatbotContact::where('telefono', $telefono)->first();
    if ($contact) {
        return response()->json([
            'found' => true,
            'nombre' => $contact->nombre,
            'carrera' => $contact->carrera,
        ]);
    } else {
        return response()->json(['found' => false]);
    }
});
require_once __DIR__.'/api_chatbot_careers.php';
