<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadershipTeam extends Model
{
    use HasFactory;

    protected $table = "leadership_teams";

    protected $fillable = ["name", "position", "bio", "image_path", "order"];
}
