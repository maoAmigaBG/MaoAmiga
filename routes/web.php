<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\HandleInertiaRequests;
use Inertia\Inertia;

Route::middleware(HandleInertiaRequests::class)->group(function () {
    Route::get('/', function () {
        return Inertia::render('Home');
    });

    Route::get('/ong', function () {
        return Inertia::render('Ong');
    });

    Route::get('/sobre', function () {
        return Inertia::render('Sobre');
    });
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
