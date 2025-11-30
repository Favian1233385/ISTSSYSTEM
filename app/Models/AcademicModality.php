<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicModality extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'description', 'icon', 'is_active', 'order'
    ];

    public function programs()
    {
        return $this->hasMany(AcademicProgram::class);
    }
}
