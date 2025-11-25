<?php

namespace App\Http\Controllers;

use App\Models\QA;
use Illuminate\Http\Request;

class QAController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('responder');
        $this->middleware('is_admin')->except('responder');
    }

    public function index()
    {
        $qas = QA::paginate(10);
        
        // Cargar estadísticas de mensajes para la pestaña de conversaciones
        $messageStats = [
            'total' => \App\Models\ChatMessage::count(),
            'today' => \App\Models\ChatMessage::whereDate('created_at', today())->count(),
            'week' => \App\Models\ChatMessage::where('created_at', '>=', now()->subDays(7))->count(),
            'sessions' => \App\Models\ChatMessage::distinct('session_id')->count('session_id'),
        ];
        
        return view('admin.qas.index', [
            'title' => 'Gestión de Chatbot - ISTS Admin',
            'items' => $qas,
            'messageStats' => $messageStats,
        ]);
    }

    public function create()
    {
        return view('admin.qas.create', ['title' => 'Añadir Q&A - ISTS Admin']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        QA::create($request->all());

        return redirect()->route('admin.qas.index')->with('success', 'Q&A añadido exitosamente.');
    }

    public function edit(QA $qa)
    {
        return view('admin.qas.edit', [
            'title' => 'Editar Q&A - ISTS Admin',
            'item' => $qa,
        ]);
    }

    public function update(Request $request, QA $qa)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $qa->update($request->all());

        return redirect()->route('admin.qas.index')->with('success', 'Q&A actualizado exitosamente.');
    }

    public function destroy(QA $qa)
    {
        $qa->delete();
        return redirect()->route('admin.qas.index')->with('success', 'Q&A eliminado exitosamente.');
    }

    public function responder(Request $request)
    {
        $mensaje = mb_strtolower(trim($request->input('mensaje', '')));

        // 1. Buscar en Q&A predefinidas (prioridad más alta)
        $qaResponse = $this->buscarEnQA($mensaje);
        if ($qaResponse) {
            return response()->json([
                'success' => true,
                'respuesta' => $qaResponse,
                'fuente' => 'qa'
            ]);
        }

        // 2. Buscar en carreras (incluye inscripciones, matrículas, registro)
        $carrerasResponse = $this->buscarEnCarreras($mensaje);
        if ($carrerasResponse) {
            return response()->json([
                'success' => true,
                'respuesta' => $carrerasResponse,
                'fuente' => 'carreras'
            ]);
        }

        // 3. Buscar en contenidos publicados (sin limitar por palabras clave)
        $contentResponse = $this->buscarEnContenidosCompleto($mensaje);
        if ($contentResponse) {
            return response()->json([
                'success' => true,
                'respuesta' => $contentResponse,
                'fuente' => 'contenidos'
            ]);
        }

        // 4. Buscar en noticias (sin limitar por palabras clave)
        $newsResponse = $this->buscarEnNoticiasCompleto($mensaje);
        if ($newsResponse) {
            return response()->json([
                'success' => true,
                'respuesta' => $newsResponse,
                'fuente' => 'noticias'
            ]);
        }

        // 5. Buscar en configuraciones (contacto, horarios, etc.)
        $settingsResponse = $this->buscarEnConfiguracionCompleto($mensaje);
        if ($settingsResponse) {
            return response()->json([
                'success' => true,
                'respuesta' => $settingsResponse,
                'fuente' => 'configuracion'
            ]);
        }

        // Si no encuentra nada, respuesta por defecto con sugerencias
        return response()->json([
            'success' => false,
            'respuesta' => $this->respuestaDefault($mensaje)
        ]);
    }
    
    /**
     * Buscar en Q&A predefinidas
     */
    private function buscarEnQA($mensaje)
    {
        // Buscar coincidencia exacta o parcial
        $qa = QA::where(function($query) use ($mensaje) {
            $query->where('question', 'LIKE', "%{$mensaje}%")
                  ->orWhereRaw('LOWER(question) LIKE ?', ["%{$mensaje}%"]);
        })->first();
        
        return $qa ? $qa->answer : null;
    }
    
    /**
     * Buscar información en carreras
     */
    private function buscarEnCarreras($mensaje)
    {
        $palabrasClave = ['carrera', 'carreras', 'estudiar', 'oferta', 'tecnología', 'programa', 'inscripción', 'inscripciones', 'matrícula', 'matrículas', 'registro', 'registrar'];

        $carreras = \App\Models\Career::where('is_active', true)->get();
        if ($carreras->isEmpty()) {
            return null;
        }

        // Buscar por palabras clave en todos los campos relevantes
        foreach ($carreras as $carrera) {
            $campos = [
                mb_strtolower($carrera->name),
                mb_strtolower($carrera->description),
                mb_strtolower($carrera->full_description),
                mb_strtolower($carrera->professional_profile),
                mb_strtolower($carrera->slug)
            ];
            foreach ($campos as $campo) {
                if ($campo && strpos($campo, $mensaje) !== false) {
                    $respuesta = "📚 *{$carrera->name}*\n\n";
                    $respuesta .= $carrera->description ?: $carrera->full_description;
                    if ($carrera->coordinator) {
                        $respuesta .= "\n\n👨‍🏫 Coordinador: {$carrera->coordinator}";
                    }
                    // Imagen
                    if (!empty($carrera->image_url)) {
                        $respuesta .= "\n\n🖼️ Imagen: {$carrera->image_url}";
                    }
                    // Video
                    if (!empty($carrera->video_url)) {
                        $respuesta .= "\n\n🎬 Video: {$carrera->video_url}";
                    }
                    $respuesta .= "\n\n💡 Para más información, visita nuestra página de carreras.";
                    return $respuesta;
                }
            }
        }

        // Si el mensaje contiene alguna palabra clave general
        if ($this->contienePalabrasClave($mensaje, $palabrasClave)) {
            $respuesta = "🎓 *Nuestras Carreras Tecnológicas:*\n\n";
            foreach ($carreras as $carrera) {
                $respuesta .= "• {$carrera->name}\n";
            }
            $respuesta .= "\n¿Sobre cuál carrera te gustaría saber más?";
            return $respuesta;
        }

        return null;
    }
    
    /**
     * Buscar en contenidos del sitio (búsqueda completa)
     */
    private function buscarEnContenidosCompleto($mensaje)
    {
        $contenido = \DB::table('contents')
            ->where('status', 'published')
            ->where(function($query) use ($mensaje) {
                $query->whereRaw('LOWER(title) LIKE ?', ["%{$mensaje}%"])
                      ->orWhereRaw('LOWER(slug) LIKE ?', ["%{$mensaje}%"])
                      ->orWhereRaw('LOWER(description) LIKE ?', ["%{$mensaje}%"])
                      ->orWhereRaw('LOWER(content) LIKE ?', ["%{$mensaje}%"]);
            })
            ->first();

        if ($contenido) {
            $respuesta = "*{$contenido->title}*\n\n";
            $respuesta .= strip_tags($contenido->description ?: $contenido->content);
            // Imagen
            if (!empty($contenido->image_url)) {
                $respuesta .= "\n\n🖼️ Imagen: {$contenido->image_url}";
            }
            // Video
            if (!empty($contenido->video_url)) {
                $respuesta .= "\n\n🎬 Video: {$contenido->video_url}";
            }
            $respuesta = substr($respuesta, 0, 700) . (strlen($respuesta) > 700 ? '...' : '');
            return $respuesta;
        }
        return null;
    }
    
    /**
     * Buscar en noticias (búsqueda completa)
     */
    private function buscarEnNoticiasCompleto($mensaje)
    {
        $noticia = \DB::table('news')
            ->where('status', 'published')
            ->where(function($query) use ($mensaje) {
                $query->whereRaw('LOWER(title) LIKE ?', ["%{$mensaje}%"])
                      ->orWhereRaw('LOWER(description) LIKE ?', ["%{$mensaje}%"])
                      ->orWhereRaw('LOWER(content) LIKE ?', ["%{$mensaje}%"]);
            })
            ->orderBy('published_at', 'desc')
            ->first();

        if ($noticia) {
            $respuesta = "📰 *{$noticia->title}*\n\n";
            $respuesta .= strip_tags($noticia->description ?: $noticia->content);
            // Imagen
            if (!empty($noticia->image_url)) {
                $respuesta .= "\n\n🖼️ Imagen: {$noticia->image_url}";
            }
            // Video
            if (!empty($noticia->video_url)) {
                $respuesta .= "\n\n🎬 Video: {$noticia->video_url}";
            }
            $respuesta = substr($respuesta, 0, 700) . (strlen($respuesta) > 700 ? '...' : '');
            return $respuesta;
        }
        return null;
    }
    
    /**
     * Buscar en configuración (contacto, horarios, etc.) - búsqueda completa
     */
    private function buscarEnConfiguracionCompleto($mensaje)
    {
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
        $respuesta = "";
        foreach ($settings as $key => $value) {
            if ($value && strpos(mb_strtolower($value), $mensaje) !== false) {
                $respuesta .= "{$key}: {$value}\n";
            }
        }
        if ($respuesta) {
            return "⚙️ *Configuración encontrada:*\n\n" . $respuesta;
        }
        return null;
    }
    
    /**
     * Verificar si el mensaje contiene palabras clave
     */
    private function contienePalabrasClave($mensaje, $palabras)
    {
        foreach ($palabras as $palabra) {
            if (strpos($mensaje, $palabra) !== false) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * Respuesta por defecto inteligente con sugerencias
     */
    private function respuestaDefault($mensaje)
    {
        $sugerencias = [
            "🤔 No encontré información específica sobre eso.\n\n",
            "Puedo ayudarte con:\n",
            "• Información sobre nuestras carreras\n",
            "• Horarios de atención\n",
            "• Datos de contacto\n",
            "• Ubicación del instituto\n",
            "• Noticias y eventos\n\n",
            "¿Sobre qué te gustaría saber?"
        ];
        
        return implode('', $sugerencias);
    }
}