<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatbotSetting extends Model
{
    protected $fillable = [
        'fallback_message',
        'contact_phone',
        'contact_email',
        'contact_hours',
        'welcome_message',
    ];
}
