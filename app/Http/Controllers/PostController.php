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

    public function getPosts()
    {
        //Obtiene los posts en orden aleatorio
        $posts = Post::inRandomOrder()->get();
        return response()->json($posts, 200);
    }

    public function getPostsInvitado()
    {
        //Obtiene los posts ordenados por likes y comentarios
        $posts = Post::orderBy('likes', 'desc')->orderBy('comments', 'desc')->get();
        return response()->json($posts, 200);
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
