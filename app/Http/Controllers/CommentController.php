<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $token = $request->header('Authorization');

        $user = JWTAuth::toUser($token);


        $comment = Comment::create([
            'text' => $request->text,
            'date' => $request->date,
            'user_id' => $user->id,
            'post_id' => $request->post_id,
        ]);

        return response()->json([
            'comment' => $comment,
        ], 200);
    }

    public function getComments(string $id)
    {
        $comments = Comment::where('post_id', $id)->get();
        return response()->json(
            $comments, 200
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
