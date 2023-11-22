<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {

        $token = $request->header('Authorization');

        $user = JWTAuth::toUser($token);

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $request->image_path,
            'likes' => $request->likes,
            'comments' => $request->comments,
            'user_id' => $user->id,
        ]);

        return response()->json([
            'post' => $post,
        ], 200);
    }

    public function getPosts(Request $request)
    {
        try {
            $token = $request->header('Authorization');
            $user = JWTAuth::toUser($token);

            // Verifica si se ha encontrado un usuario
            if ($user) {
                // Si es un usuario autenticado, obtener publicaciones aleatorias
                $posts = Post::inRandomOrder()->get();
            } else {
                // Si es un invitado, obtener publicaciones ordenadas por likes y comentarios en orden ascendente
                $posts = Post::orderBy('likes', 'asc')->orderBy('comments', 'asc')->get();
            }

            return response()->json(['posts' => $posts]);
        } catch (\Exception $e) {
            // Manejar errores si hay problemas con la autenticación JWT
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
