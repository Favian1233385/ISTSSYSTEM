<?php
namespace App\Chatbot\Sources;

use App\Models\Autoridad;

class AutoridadesSource
{
    // Palabras clave asociadas a esta fuente
    protected $keywords = ['autoridad', 'autoridades', 'rector', 'vicerrector', 'vocal'];

    public function canRespond($message)
    {
        $msg = strtolower($message);
        foreach ($this->keywords as $kw) {
            if (strpos($msg, $kw) !== false) {
                return true;
            }
        }
        return false;
    }

    public function getResponse($message)
    {
        $autoridades = Autoridad::all();
        if ($autoridades->count()) {
            $respuesta = "Autoridades actuales:\n";
            foreach ($autoridades as $a) {
                $respuesta .= "- {$a->nombre} ({$a->cargo})\n";
            }
            return $respuesta;
        }
        return "No se encontraron autoridades registradas.";
    }
}
