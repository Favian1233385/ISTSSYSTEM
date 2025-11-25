<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "title",
        "department",
        "bio",
        "image_path",
        "pdf_path",
        "order",
    ];
}
