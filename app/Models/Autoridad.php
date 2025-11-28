<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autoridad extends Model
{
    use HasFactory;

    protected $table = "autoridades";

    protected $fillable = [
        "nombre",
        "slug",
        "cargo",
        "categoria",
        "biografia",
        "foto_path",
        "pdf_path",
        "orden",
    ];
}
