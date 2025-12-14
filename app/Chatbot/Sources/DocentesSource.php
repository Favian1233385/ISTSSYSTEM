<?php
namespace App\Chatbot\Sources;

use App\Models\Teacher;

class DocentesSource
{
    // Palabras clave asociadas a esta fuente
    protected $keywords = ['docente', 'docentes', 'profesor', 'profesores', 'planta docente'];

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
        $docentes = Teacher::all();
        if ($docentes->count()) {
            $respuesta = "Planta docente actual:\n";
            foreach ($docentes as $d) {
                $respuesta .= "- {$d->name} ({$d->title})\n";
            }
            return $respuesta;
        }
        return "No se encontraron docentes registrados.";
    }
}
