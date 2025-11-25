<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'content',
        'author',
        'category',
        'status',
        'author_id',
        'images',
        'published_at',
        'featured',
        'views'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'featured' => 'boolean',
        'views' => 'integer',
        'images' => 'array',
    ];


    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeRecent($query, $limit = 10)
    {
        return $query->published()->orderBy('published_at', 'desc')->limit($limit);
    }

    // Increment views
    public function incrementViews()
    {
        $this->increment('views');
    }
}
