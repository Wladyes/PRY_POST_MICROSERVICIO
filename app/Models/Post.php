<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Permite asignación masiva
    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];
}
