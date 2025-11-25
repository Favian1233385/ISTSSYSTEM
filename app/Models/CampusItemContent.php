<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampusItemContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'campus_item_id',
        'title',
        'date',
        'description',
        'external_url',
        'pdf_url',
        'image_url',
        'image_path',
        'video_url',
        'video_path',
        'contact_name',
        'contact_email',
        'contact_phone',
        'form_html',
        'is_active',
    ];

    public function campusItem()
    {
        return $this->belongsTo(CampusItem::class);
    }

    public function formSubmissions()
    {
        return $this->hasMany(CampusItemFormSubmission::class);
    }
}
