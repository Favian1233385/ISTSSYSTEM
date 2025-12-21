<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QA;
use App\Models\ChatMessage;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Helpers\ChatbotHelper;

class ChatbotController extends Controller
{
      // Fuentes de conocimiento dinámicas
    private $knowledgeSources = [
        \App\Chatbot\Sources\AutoridadesSource::class,
        \App\Chatbot\Sources\DocentesSource::class,
        \App\Chatbot\Sources\TramitesSource::class,
        // Puedes agregar más aquí
    ];
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
        $message = $this->normalizeText(trim($message));
        $qas = QA::all();

        // 1. Coincidencia exacta (normalizada)
        foreach ($qas as $qa) {
            $questions = array_map(function($q) { return $this->normalizeText(trim($q)); }, explode(",", $qa->question));
            if (in_array($message, $questions)) {
                return strip_tags($qa->answer);
            }
        }

        // 2. Coincidencia por palabra clave contenida (más flexible, normalizada)
        foreach ($qas as $qa) {
            $keywords = array_map(function($q) { return $this->normalizeText(trim($q)); }, explode(",", $qa->question));
            foreach ($keywords as $keyword) {
                if (!empty($keyword) && strpos($message, $keyword) !== false) {
                    return strip_tags($qa->answer);
                }
            }
        }

        
      
        // Fallback: recorrer fuentes de conocimiento dinámicas
            foreach ($this->knowledgeSources as $sourceClass) {
                $source = new $sourceClass();
                if ($source->canRespond($message)) {
                    return $source->getResponse($message);
                }   
            }

        // 3. Buscar en carreras
        $careers = \App\Models\Career::active()->get();
        foreach ($careers as $career) {
            if (strpos($this->normalizeText($message), $this->normalizeText($career->name)) !== false) {
                // Si el mensaje menciona la carrera pero no hay respuesta específica al tema
                $coordinator = $career->coordinator;
                $email = $career->coordinator_email;
                $contactInfo = '';
                if ($coordinator && $email) {
                    $contactInfo = "\nSi necesitas información específica sobre la carrera, por favor comunícate con el coordinador/a: $coordinator (Email: $email). El horario de oficina es de 14:00 a 22:00.";
                } elseif ($coordinator) {
                    $contactInfo = "\nSi necesitas información específica sobre la carrera, por favor comunícate con el coordinador/a: $coordinator. El horario de oficina es de 14:00 a 22:00.";
                } elseif ($email) {
                    $contactInfo = "\nPara más información, puedes escribir al email del coordinador/a: $email. El horario de oficina es de 14:00 a 22:00.";
                } else {
                    $contactInfo = "\nPara más información visita la sección de carreras o comunícate con Secretaría Académica.";
                }
                return "Carrera: " . $career->name . "\n" . ($career->description ?: $career->full_description ?: "Para más información visita la sección de carreras.") . $contactInfo;
            }
        }

        // 4. Buscar en noticias (normalizado)
        $news = \App\Models\News::published()->recent(5)->get();
        foreach ($news as $item) {
            if (strpos($message, $this->normalizeText($item->title)) !== false) {
                return "Noticia: " . $item->title . "\n" . ($item->summary ?: $item->content);
            }
        }

        // 5. Buscar en contenidos (normalizado, acceso seguro)
        $contentModel = new \App\Models\Content();
        $contents = $contentModel->search($message, 3);
        if (!empty($contents) && isset($contents[0]["title"])) {
            $first = $contents[0];
            $titleNorm = $this->normalizeText($first["title"] ?? '');
            if ($titleNorm && strpos($message, $titleNorm) !== false) {
                return "Contenido relacionado: " . $first["title"] . "\n" . (($first["description"] ?? '') ?: ($first["content"] ?? ''));
            }
        }

        // 6. Buscar en actualizaciones (normalizado)
        $updates = \App\Models\Update::active()->ordered()->limit(3)->get();
        foreach ($updates as $update) {
            if (strpos($message, $this->normalizeText($update->title)) !== false) {
                return "Actualización: " . $update->title . "\n" . $update->description;
            }
        }

        // 7. Mensaje del rector (normalizado)
        if (strpos($message, $this->normalizeText("rector")) !== false) {
            $rector = \App\Models\Rector::where('is_active', true)->first();
            if ($rector) {
                return "Mensaje del Rector " . $rector->name . ":\n" . $rector->message;
            }
        }

        // Default response (si no hay información específica)
        try {
            return ChatbotHelper::getFallbackMessage();
        } catch (\Throwable $e) {
            return 'Gracias por tu mensaje. No he encontrado una respuesta exacta, pero puedes consultar nuestras carreras, noticias, actualizaciones o contactar a un asesor para más información.';
        }
    }
    /**
    * Normaliza texto eliminando tildes y caracteres especiales
    */
    private function normalizeText($text)
    {
        $text = strtolower($text);
        $text = str_replace(
            ['á','é','í','ó','ú','ñ','ü'],
            ['a','e','i','o','u','n','u'],
            $text
        );
        $text = preg_replace('/[^a-z0-9 ]/', '', $text);
        return $text;
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
        // Palabras clave genéricas para información adicional
        $genericKeywords = [
            'más información', 'mas informacion', 'información', 'informacion', 'detalles', 'detalle', 'matricula', 'matrícula', 'matricular', 'inscribirme', 'inscripción', 'inscripcion', 'quiero saber más', 'quiero saber mas', 'quiero inscribirme', 'quiero registrarme', 'quiero estudiar', 'contacto', 'coordinador', 'asesor', 'perfil profesional', 'opción profesional', 'opcion profesional'
        ];

        // Detectar si el mensaje es una palabra clave genérica
        $isGeneric = false;
        foreach ($genericKeywords as $keyword) {
            if (stripos($message, $keyword) !== false) {
                $isGeneric = true;
                break;
            }
        }

        // Si es palabra clave genérica, buscar la última carrera mencionada en la conversación
        if ($isGeneric && !empty(request()->input('session_id'))) {
            $sessionId = request()->input('session_id');
            // Buscar los últimos 10 mensajes del usuario en la sesión
            $lastMessages = \App\Models\ChatMessage::bySession($sessionId)->orderBy('id', 'desc')->limit(10)->pluck('user_message');
            $careers = \App\Models\Career::active()->get();
            foreach ($lastMessages as $userMsg) {
                foreach ($careers as $career) {
                    if (strpos($this->normalizeText($userMsg), $this->normalizeText($career->name)) !== false) {
                        // Responder con datos del coordinador
                        $coordinator = $career->coordinator;
                        $email = $career->coordinator_email;
                        $contactInfo = '';
                        if ($coordinator && $email) {
                            $contactInfo = "\nPara más información sobre la carrera de {$career->name}, comunícate con el coordinador/a: $coordinator (Email: $email). El horario de oficina es de 14:00 a 22:00.";
                        } elseif ($coordinator) {
                            $contactInfo = "\nPara más información sobre la carrera de {$career->name}, comunícate con el coordinador/a: $coordinator. El horario de oficina es de 14:00 a 22:00.";
                        } elseif ($email) {
                            $contactInfo = "\nPara más información sobre la carrera de {$career->name}, puedes escribir al email del coordinador/a: $email. El horario de oficina es de 14:00 a 22:00.";
                        } else {
                            $contactInfo = "\nPara más información visita la sección de carreras o comunícate con Secretaría Académica.";
                        }
                        // Si pregunta por perfil profesional, incluirlo si existe
                        if (stripos($this->normalizeText($message), 'perfil profesional') !== false || stripos($this->normalizeText($message), 'opcion profesional') !== false) {
                            if (!empty($career->professional_profile)) {
                                $contactInfo = "Perfil profesional de {$career->name}:\n" . $career->professional_profile . "\n" . $contactInfo;
                            }
                        }
                        return $contactInfo;
                    }
                }
            }


            // Si no se encontró carrera, pedir que la especifique
            return "Por favor, indícanos la carrera de tu interés para darte información personalizada.";
        }
                return "negative";
            }
        }

        return "neutral";
    }

}
