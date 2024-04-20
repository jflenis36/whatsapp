<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'user_id',
        'last_connection_time',
        'expiration_status',
        'name_by_whatsapp'
    ];

    protected $table = 'chat';
}
