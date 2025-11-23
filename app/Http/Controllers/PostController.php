<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Muestra una lista de todos los posts.
     * GET /api/posts
     */
    public function index()
    {
        // Obtiene todos los posts ordenados por fecha de creación descendente
        $posts = Post::orderBy('created_at', 'desc')->get();

        // Retorna la lista de posts en formato JSON
        return response()->json([
            'message' => 'Lista de posts',
            'posts' => $posts
        ], 200);
    }

    /**
     * Almacena un nuevo post en la base de datos.
     * POST /api/posts
     */
    public function store(Request $request)
    {
        // Valida los datos recibidos
        $data = $request->validate([
            'title' => 'required|string|max:255', // Título obligatorio
            'content' => 'required|string', // Contenido obligatorio
           // 'user_id' => 'required|integer|exists:users,id', // ID de usuario obligatorio y válido
        ]);

        // Obtiene el usuario autenticado desde el middleware 
        $userId = $request->auth_user['id'] ?? null;

        // Si no se encuentra el usuario autenticado, retorna error
        if (!$userId) {
        return response()->json(['error' => 'No se pudo identificar el usuario autenticado'], 401); 
    }
        // Crea el post asociado al usuario autenticado
        $post = Post::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => $userId,
        ]);

        // Retorna el post creado
        return response()->json([
            'message' => 'Post creado correctamente',
            'post' => $post
        ], 201);
    }

    /**
     * Muestra un post específico por su ID.
     * GET /api/posts/{id}
     */
    public function show($id)
    {
        // Busca el post por ID
        $post = Post::find($id);

        // Si no existe, retorna error 404
        if (!$post) {
            return response()->json([
                'message' => 'Post no encontrado'
            ], 404);
        }

        // Retorna el post encontrado
        return response()->json([
            'message' => 'Post encontrado',
            'post' => $post
        ], 200);
    }

    /**
     * Actualiza un post existente.
     * PUT/PATCH /api/posts/{id}
     */
    public function update(Request $request, $id)
    {
        // Busca el post por ID
        $post = Post::find($id);

        // Si no existe, retorna error 404
        if (!$post) {
            return response()->json([
                'message' => 'Post no encontrado'
            ], 404);
        }

        // Valida los datos recibidos
        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
        ]);

        // Actualiza los campos permitidos
        $post->update($data);

        // Retorna el post actualizado
        return response()->json([
            'message' => 'Post actualizado correctamente',
            'post' => $post
        ], 200);
    }

    /**
     * Elimina un post existente.
     * DELETE /api/posts/{id}
     */
    public function destroy($id)
    {
        // Busca el post por ID
        $post = Post::find($id);

        // Si no existe, retorna error 404
        if (!$post) {
            return response()->json([
                'message' => 'Post no encontrado'
            ], 404);
        }

        // Elimina el post
        $post->delete();

        // Retorna mensaje de éxito
        return response()->json([
            'message' => 'Post eliminado correctamente'
        ], 200);
    }
}
