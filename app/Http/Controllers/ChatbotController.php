<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QA;
use App\Models\ChatMessage;
use Exception;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    /**
     * Enviar mensaje al chatbot
     */
    public function send(Request $request)
    {
        if (!$request->isMethod('post')) {
            return response()->json([
                'success' => false,
                'message' => 'Método no permitido'
            ], 405);
        }

        // Validar token CSRF (Laravel lo hace automáticamente en web.php)

        // Rate limiting (opcional: puedes implementar con middleware si lo deseas)

        try {
            $message = trim($request->input('message', ''));
            $sessionId = trim($request->input('session_id', ''));

            if (empty($message)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mensaje vacío'
                ], 400);
            }

            // Generar respuesta del chatbot
            $response = $this->generateResponse($message);

            // Determinar si es una respuesta genérica (sin respuesta útil)
            $unanswered = false;
            $defaultResponses = [
                'Gracias por tu mensaje. No he encontrado una respuesta exacta, pero puedes consultar nuestras carreras, noticias, actualizaciones o contactar a un asesor para más información.'
            ];
            if (in_array($response, $defaultResponses)) {
                $unanswered = true;
            }

            // Guardar conversación
            ChatMessage::create([
                'session_id' => $sessionId,
                'user_message' => $message,
                'bot_response' => $response,
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent', 'unknown'),
                'sentiment' => $this->analyzeSentiment($message),
                'unanswered' => $unanswered,
            ]);

            // Puedes agregar logs aquí si lo deseas

            return response()->json([
                'success' => true,
                'response' => $response
            ]);
        } catch (Exception $e) {
                Log::error('Error en ChatbotController::send(): ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error interno del servidor'
            ], 500);
        }
    }

    /**
     * Generar respuesta del chatbot
     */
    private function generateResponse($message)
    {
        $message = strtolower(trim($message));
        $qas = QA::all();

            // 1. Coincidencia exacta
            foreach ($qas as $qa) {
                $questions = array_map("trim", explode(",", strtolower($qa->question)));
                if (in_array($message, $questions)) {
                    return strip_tags($qa->answer);
                }
            }

            // 2. Coincidencia por palabra clave contenida (más flexible)
            foreach ($qas as $qa) {
                $keywords = array_map("trim", explode(",", strtolower($qa->question)));
                foreach ($keywords as $keyword) {
                    if (!empty($keyword) && (strpos($message, $keyword) !== false || strpos($keyword, $message) !== false)) {
                        return strip_tags($qa->answer);
                    }
                }
            }

        // 3. Buscar en carreras
        $careers = \App\Models\Career::active()->get();
        foreach ($careers as $career) {
            if (stripos($message, strtolower($career->name)) !== false) {
                return "Carrera: " . $career->name . "\n" . ($career->description ?: $career->full_description ?: "Para más información visita la sección de carreras.");
            }
        }

        // 4. Buscar en noticias
        $news = \App\Models\News::published()->recent(5)->get();
        foreach ($news as $item) {
            if (stripos($message, strtolower($item->title)) !== false) {
                return "Noticia: " . $item->title . "\n" . ($item->summary ?: $item->content);
            }
        }

        // 5. Buscar en contenidos
        $contentModel = new \App\Models\Content();
        $contents = $contentModel->search($message, 3);
        if (!empty($contents)) {
            $first = $contents[0];
            return "Contenido relacionado: " . $first["title"] . "\n" . ($first["description"] ?: $first["content"]);
        }

        // 6. Buscar en actualizaciones
        $updates = \App\Models\Update::active()->ordered()->limit(3)->get();
        foreach ($updates as $update) {
            if (stripos($message, strtolower($update->title)) !== false) {
                return "Actualización: " . $update->title . "\n" . $update->description;
            }
        }

        // 7. Mensaje del rector
        if (stripos($message, "rector") !== false) {
            $rector = \App\Models\Rector::where('is_active', true)->first();
            if ($rector) {
                return "Mensaje del Rector " . $rector->name . ":\n" . $rector->message;
            }
        }

        // Default response
        return "Gracias por tu mensaje. No he encontrado una respuesta exacta, pero puedes consultar nuestras carreras, noticias, actualizaciones o contactar a un asesor para más información.";
    }

    /**
     * Analizar sentimiento del mensaje
     */
    private function analyzeSentiment($message)
    {
        $positiveWords = [
            "gracias",
            "excelente",
            "bueno",
            "genial",
            "perfecto",
            "feliz",
            "contento",
        ];
        $negativeWords = [
            "malo",
            "terrible",
            "horrible",
            "molesto",
            "enojado",
            "triste",
            "problema",
        ];

        $message = strtolower($message);

        foreach ($positiveWords as $word) {
            if (strpos($message, $word) !== false) {
                return "positive";
            }
        }

        foreach ($negativeWords as $word) {
            if (strpos($message, $word) !== false) {
                return "negative";
            }
        }

        return "neutral";
    }

}
