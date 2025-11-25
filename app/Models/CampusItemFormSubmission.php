<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampusItemFormSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'campus_item_content_id',
        'nombres',
        'cedula',
        'carrera',
        'ciclo',
        'nivel',
        'institucion',
        'pdf_path',
    ];

    public function content()
    {
        return $this->belongsTo(CampusItemContent::class, 'campus_item_content_id');
    }
}
