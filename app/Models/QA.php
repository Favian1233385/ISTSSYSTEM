<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QA extends Model
{
    use HasFactory;

    protected $table = 'q_a_s';

    protected $fillable = [
        'question',
        'answer',
    ];
}
