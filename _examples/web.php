<?php

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    $posts = [];
    if (Auth::check()) {
        $posts = Post::where("user_id", Auth::id())->get();
    }
    return view('home', ["posts" => $posts]);
});

Route::post('/register', [UserController::class, "register"]);
Route::post('/logout', [UserController::class, "logout"]);
Route::post('/login', [UserController::class, "login"]);

Route::post('/create-post', [PostController::class, "insert_post"]);
Route::get('/edit-post/{post}', [PostController::class, "edit_post"]);
Route::put('/edit-post/{post}', [PostController::class, "update_post"]);
Route::delete('/delete-post/{post}', [PostController::class, "delete_post"]);
