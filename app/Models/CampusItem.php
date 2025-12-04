<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampusItem extends Model
{
    use HasFactory;

    public function contents()
    {
        return $this->hasMany(CampusItemContent::class)->orderBy('date', 'desc');
    }
    protected $fillable = [
        'title',
        'description',
        'url',
        'content',
        'is_external',
        'category',
        'order',
        'is_active',
        'schedule',
        'location',
        'phone',
        'email',
        'manager',
        'functions',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_external' => 'boolean',
        'functions' => 'array',
    ];

    /**
     * Scope para obtener solo items activos
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para obtener items por categoría
     */
    public function scopeByCategory($query, $category)
    {
        // Normalizar categoría para búsqueda flexible
        $normalized = strtolower(str_replace([' ', 'á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ'], ['_', 'a', 'e', 'i', 'o', 'u', 'u', 'n'], $category));
        return $query->whereRaw("LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(category, ' ', '_'), 'á', 'a'), 'é', 'e'), 'í', 'i'), 'ó', 'o'), 'ú', 'u'), 'ü', 'u'), 'ñ', 'n')) = ?", [$normalized]);
    }

    /**
     * Scope para ordenar por campo order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    /**
     * Relación con imágenes
     */
    public function images()
    {
        return $this->hasMany(CampusItemImage::class)->orderBy('order');
    }
}
