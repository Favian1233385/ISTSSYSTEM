<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'message',
        'link',
        'is_active',
        'fecha_inicio',
        'fecha_fin',
    ];
}
