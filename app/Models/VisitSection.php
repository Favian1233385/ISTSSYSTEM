<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'mission',
        'functions',
        'schedule',
        'location',
        'phone',
        'email',
        'additional_info',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'functions' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Scope para secciones activas
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para ordenar por sort_order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }

    /**
     * Generar slug automáticamente
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($section) {
            if (empty($section->slug)) {
                $section->slug = \Illuminate\Support\Str::slug($section->title);
            }
        });
    }
}
