<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Permite asignación masiva de estos campos para crear un post
    protected $fillable = [
        'title', // Título del post
        'content', // Contenido del post
        'user_id', // ID del usuario que creó el post
    ];
}
