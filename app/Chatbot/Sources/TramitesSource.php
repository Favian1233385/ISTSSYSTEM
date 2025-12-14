<?php
namespace App\Chatbot\Sources;

use App\Models\Tramite;

class TramitesSource
{
    // Palabras clave asociadas a esta fuente
    protected $keywords = [
        'trámite', 'trámites', 'proceso', 'procesos', 'matrícula', 'matrículas', 'inscripción', 'inscripciones', 'admisión', 'admisiones', 'registro nacional', 'requisitos', 'documentos', 'solicitud', 'certificado', 'constancia'
    ];

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
        $tramites = Tramite::all();
        if ($tramites->count()) {
            $respuesta = "Información sobre trámites y procesos:\n";
            foreach ($tramites as $t) {
                $respuesta .= "- {$t->nombre}: {$t->descripcion}\n";
            }
            return $respuesta;
        }
        return "No se encontraron trámites registrados.";
    }
}
