<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| API Routes - Microservicio de Posts
|--------------------------------------------------------------------------
|
| Todas las rutas de este archivo están protegidas por el middleware
| personalizado 'auth.micro', que valida el token consultando el
| microservicio de autenticación.
|
| Solo los usuarios autenticados (con token válido) pueden acceder
| al CRUD de posts.
|
*/

// CRUD completo de posts protegido por el middleware 'auth.micro'
Route::middleware('auth.micro')->group(function () {
    Route::apiResource('posts', PostController::class);
});

/*
    Esto crea automáticamente las siguientes rutas:
    - GET    /api/posts           -> index   (listar todos los posts)
    - POST   /api/posts           -> store   (crear un post)
    - GET    /api/posts/{post}    -> show    (ver un post por ID)
    - PUT    /api/posts/{post}    -> update  (actualizar un post)
    - PATCH  /api/posts/{post}    -> update  (actualizar un post)
    - DELETE /api/posts/{post}    -> destroy (eliminar un post)
*/
