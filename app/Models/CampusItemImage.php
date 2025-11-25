<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampusItemImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'campus_item_id',
        'image_path',
        'caption',
        'order'
    ];

    public function campusItem()
    {
        return $this->belongsTo(CampusItem::class);
    }
}
