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
        'pdf_url'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_external' => 'boolean',
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
        return $query->where('category', $category);
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
