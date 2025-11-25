<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicSection extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "slug",
        "description",
        "content",
        "image_path",
        "is_active",
        "sort_order",
    ];

    protected $casts = [
        "is_active" => "boolean",
    ];

    public function scopeActive($query)
    {
        return $query->where("is_active", true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy("sort_order", "asc");
    }

    /**
     * Get the careers associated with the academic section.
     */
    public function careers()
    {
        return $this->hasMany(Career::class, "academic_section_id");
    }
}
