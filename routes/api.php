<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('posts', [PostController::class, 'getPosts']);

Route::middleware('jwt.verify')->group(function (){
    Route::get('users', [UserController::class, 'index']);
    Route::post('post', [PostController::class, 'store']);
    Route::post('comment', [CommentController::class, 'store']);
    Route::get('/usuarios/{id}', [UserController::class, 'getUser']);
    Route::get('/posts/{id}', [PostController::class, 'getPost']);
    Route::get('/comments/{id}', [CommentController::class, 'getComments']);
});


