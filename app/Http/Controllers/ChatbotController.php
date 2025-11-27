<?php
/**
 * Controlador de Chatbot - Sistema ISTS
 * Manejo del asistente virtual
 */

use App\Models\QA;

class ChatbotController extends Controller
{
    private $chatMessageModel;

    public function __construct()
    {
        $this->chatMessageModel = $this->model("ChatMessage");
    }

    /**
     * Enviar mensaje al chatbot
     */
    public function send()
    {
        // Verificar que sea una petición POST
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            $this->jsonResponse(
                ["success" => false, "message" => "Método no permitido"],
                405,
            );
            return;
        }

        // Verificar token CSRF
        if (!Security::validateCSRFToken($_POST["csrf_token"] ?? "")) {
            $this->jsonResponse(
                ["success" => false, "message" => "Token CSRF inválido"],
                403,
            );
            return;
        }

        // Rate limiting
        if (!Security::checkRateLimit("chatbot", 20, 60)) {
            $this->jsonResponse(
                [
                    "success" => false,
                    "message" => "Demasiados mensajes. Intenta más tarde.",
                ],
                429,
            );
            return;
        }

        try {
            // Sanitizar entrada
            $message = Security::sanitizeInput(
                $_POST["message"] ?? "",
                "string",
            );
            $sessionId = Security::sanitizeInput(
                $_POST["session_id"] ?? "",
                "string",
            );

            if (empty($message)) {
                $this->jsonResponse(
                    ["success" => false, "message" => "Mensaje vacío"],
                    400,
                );
                return;
            }

            // Generar respuesta del chatbot
            $response = $this->generateResponse($message);

            // Guardar conversación
            $this->chatMessageModel->save([
                "session_id" => $sessionId,
                "user_message" => $message,
                "bot_response" => $response,
                "ip_address" => $_SERVER["REMOTE_ADDR"] ?? "unknown",
                "user_agent" => $_SERVER["HTTP_USER_AGENT"] ?? "unknown",
                "sentiment" => $this->analyzeSentiment($message),
            ]);

            // Log de interacción
            Security::logSecurity(
                "chatbot_interaction",
                null,
                "Mensaje: $message",
                "low",
            );

            $this->jsonResponse([
                "success" => true,
                "response" => $response,
            ]);
        } catch (Exception $e) {
            error_log(
                "Error en ChatbotController::send(): " . $e->getMessage(),
            );
            $this->jsonResponse(
                ["success" => false, "message" => "Error interno del servidor"],
                500,
            );
        }
    }

    /**
     * Generar respuesta del chatbot
     */
    private function generateResponse($message)
    {
        $message = strtolower(trim($message));
        $qas = QA::all();

        // 1. Check for exact match
        foreach ($qas as $qa) {
            $questions = array_map("trim", explode(",", strtolower($qa->question)));
            if (in_array($message, $questions)) {
                return $qa->answer;
            }
        }

        // 2. Check for keyword match
        foreach ($qas as $qa) {
            $keywords = array_map("trim", explode(",", strtolower($qa->question)));
            foreach ($keywords as $keyword) {
                if (!empty($keyword) && strpos($message, $keyword) !== false) {
                    return $qa->answer;
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

    /**
     * Obtener estadísticas del chatbot
     */
    public function stats()
    {
        if (!Security::isAuthenticated() || !Security::hasRole("admin")) {
            $this->jsonResponse(
                ["success" => false, "message" => "Acceso denegado"],
                403,
            );
            return;
        }

        try {
            $stats = $this->chatMessageModel->getStatistics();
            $this->jsonResponse(["success" => true, "stats" => $stats]);
        } catch (Exception $e) {
            error_log(
                "Error en ChatbotController::stats(): " . $e->getMessage(),
            );
            $this->jsonResponse(
                [
                    "success" => false,
                    "message" => "Error al obtener estadísticas",
                ],
                500,
            );
        }
    }

    /**
     * Obtener mensajes recientes
     */
    public function recent()
    {
        if (!Security::isAuthenticated() || !Security::hasRole("admin")) {
            $this->jsonResponse(
                ["success" => false, "message" => "Acceso denegado"],
                403,
            );
            return;
        }

        try {
            $limit = intval($_GET["limit"] ?? 50);
            $messages = $this->chatMessageModel->getRecentMessages($limit);
            $this->jsonResponse(["success" => true, "messages" => $messages]);
        } catch (Exception $e) {
            error_log(
                "Error en ChatbotController::recent(): " . $e->getMessage(),
            );
            $this->jsonResponse(
                ["success" => false, "message" => "Error al obtener mensajes"],
                500,
            );
        }
    }
}
?>
