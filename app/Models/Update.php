<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'description',
        'image_path',
        'video_url',
        'video_path',
        'link_url',
        'link_text',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'date' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Scope para obtener solo actualizaciones activas
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para ordenar por sort_order y fecha
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('date', 'desc');
    }

    /**
     * Scope para obtener actualizaciones recientes
     */
    public function scopeRecent($query, $limit = 3)
    {
        return $query->active()->ordered()->limit($limit);
    }
}
