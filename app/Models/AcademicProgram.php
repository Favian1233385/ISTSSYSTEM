<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicProgram extends Model
{
    use HasFactory;
    protected $fillable = [
        'academic_modality_id', 'title', 'description', 'url', 'document', 'is_active', 'order'
    ];

    public function modality()
    {
        return $this->belongsTo(AcademicModality::class, 'academic_modality_id');
    }
}
