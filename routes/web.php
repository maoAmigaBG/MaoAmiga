<?php

use App\Models\Ong;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('index');
});

Route::get('/ong', function () {
    return view('Ong');
});

Route::get('/sobre', function () {
    return view('about');
});

/* Route::get('/', function () {
    if (Auth::check()) {
        $posts = Post::all();
        $ongs = Ong::orderBy('created_at', 'desc')->take(5)->get();
        return view("index", [
            "posts" => $posts,
            "ongs" => $ongs,
        ]);
    }
    return redirect("login");
});

Route::get("login", function () {
    return view("login");
});
Route::get("logon", function () {
    return view("logon");
});

Route::get("/logout", [UserController::class, "logout"]);
Route::post("/auth_login", [UserController::class, "login"]);
Route::post("/auth_logon", [UserController::class, "register"]); */
