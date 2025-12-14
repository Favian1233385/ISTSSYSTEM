<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'description',
        'date',
        'place',
        'image_path',
        'status',
    ];

    protected $dates = ['date'];

    public function images()
    {
        return $this->hasMany(EventImage::class);
    }

    public function files()
    {
        return $this->hasMany(EventFile::class);
    }

    public function links()
    {
        return $this->hasMany(EventLink::class);
    }
}
