<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimelineEvent extends Model
{
    use HasFactory;

    protected $table = 'timeline_events';

    protected $fillable = [
        'year',
        'title',
        'description',
        'order',
        'is_public',
    ];

    public $timestamps = true;
}
