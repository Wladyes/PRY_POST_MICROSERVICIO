<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * genera la migración.
     */
    public function up(): void
    {    // Crea la tabla 'posts' con los campos necesarios
        Schema::create('posts', function (Blueprint $table) {  // Define las columnas de la tabla
            $table->id();        // ID autoincremental
            $table->string('title');    // Título del post
            $table->text('content');    // Contenido del post
            $table->unsignedBigInteger('user_id'); // ID del usuario que creó el post
            $table->timestamps(); // Marca de tiempo de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
