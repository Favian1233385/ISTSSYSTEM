<?php
namespace App\Chatbot\Sources;

use App\Models\Career;

class CarrerasSource
{
    // Palabras clave asociadas a esta fuente (ampliado para lenguaje natural)
    protected $keywords = [
        'carrera', 'carreras',
        'programa', 'programas',
        'programa de grado', 'programas de grado',
        'especialidad', 'especialidades',
        'tecnología', 'tecnologías',
        'grado', 'grados'
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
        // Solo carreras activas y ordenadas
        $carreras = Career::active()->ordered()->get();
        if ($carreras->count()) {
            $respuesta = "Carreras tecnológicas disponibles:\n";
            foreach ($carreras as $c) {
                $respuesta .= "- {$c->name}";
                if (!empty($c->description)) {
                    $respuesta .= " ({$c->description})";
                }
                $respuesta .= "\n";
            }
            return $respuesta;
        }
        return "No se encontraron carreras registradas.";
    }
}
