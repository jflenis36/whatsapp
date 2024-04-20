<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesagge extends Model
{
    protected $fillable = [
        'chat_id',
        'message_from_ziro',
        'message_text',
        'type_message_id',
        'message_status_id',
        'fiel_id',
        'writing_state'
    ];

    protected $table = 'mesagge';
}
