<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $fillable = [
        "academic_section_id",
        "name",
        "slug",
        "description",
        "full_description",
        "professional_profile",
        "coordinator",
        "coordinator_email",
        "image_path",
        "image_path_2",
        "curriculum_pdf",
        "is_active",
        "sort_order",
    ];

    protected $casts = [
        "is_active" => "boolean",
    ];

    /**
     * Get the academic section that this career belongs to.
     */
    public function academicSection()
    {
        return $this->belongsTo(AcademicSection::class);
    }

    /**
     * Scope para obtener solo carreras activas
     */
    public function scopeActive($query)
    {
        return $query->where("is_active", true);
    }

    /**
     * Scope para ordenar por sort_order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy("sort_order", "asc")->orderBy("name", "asc");
    }
}
