<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventLink extends Model
{
    use HasFactory;
    protected $fillable = ['event_id', 'url', 'label'];
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
