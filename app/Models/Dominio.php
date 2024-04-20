<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dominio extends Model
{
    protected $fillable = [
        'group_code',
        'name',
        'code',
        'description'
    ];

    protected $table = 'dominio';
}
