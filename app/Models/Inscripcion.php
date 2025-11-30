<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $table = 'inscripciones';

    protected $fillable = [
        'nombre',
        'cedula',
        'email',
        'telefono',
        'especialidad',
        'modalidad_id',
        'programa_id',
        'observaciones',
    ];

    public function modalidad()
    {
        return $this->belongsTo(\App\Models\AcademicSection::class, 'modalidad_id');
    }

    public function programa()
    {
        return $this->belongsTo(\App\Models\AcademicProgram::class, 'programa_id');
    }
}
