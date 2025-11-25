<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rector extends Model
{
    use HasFactory;

    protected $table = 'rectors';

    protected $fillable = [
        'name',
        'image_path',
        'message',
        'position',
        'academic_title',
        'is_active',
    ];
}
