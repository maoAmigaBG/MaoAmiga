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

//alessandro, essas são as rotas de authentication (deixei junto os uses de controllers):

/*
use App\Http\Controllers\OngController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get("/", [OngController::class, "index"])->name("index"); // não sei se assim fica bom para ti, faça como quiser

Route::prefix("/user")->group(function() {
    Route::get("/login", [UserController::class, "login"])->name("user.login");
    Route::get("/logon", [UserController::class, "logon"])->name("user.logon");
    Route::get("/logout", [UserController::class, "logout"])->name("user.logout");
});
Route::prefix("/auth")->group(function() {
    Route::post("/login", [UserController::class, "auth_login"])->name("auth.login");
    Route::post("/logon", [UserController::class, "auth_logon"])->name("auth.logon");
});
*/