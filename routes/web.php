<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\HandleInertiaRequests;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OngController;

Route::middleware(HandleInertiaRequests::class)->group(function () {
    Route::get('/', function () {
        return Inertia::render('Home');
    })->name('index');

    Route::get('/ong', function () {
        return Inertia::render('Ong');
    });

    Route::get('/sobre', function () {
        return Inertia::render('Sobre');
    });
});


Route::middleware(HandleInertiaRequests::class)->prefix("/user")->group(function() {
    Route::get("/login", [UserController::class, "login"])->name("login");
    Route::get("/logon", [UserController::class, "logon"])->name("logon");
});

Route::prefix("/auth")->group(function() {
    Route::post("/login", [UserController::class, "auth_login"])->name("auth.login");
    Route::post("/logon", [UserController::class, "auth_logon"])->name("auth.logon");
    Route::post("/logout", [UserController::class, "logout"])->name("auth.logout");
});

//alessandro, essas são as rotas de authentication (deixei junto os uses de controllers):

/*

Route::get("/", [OngController::class, "index"])->name("index"); // não sei se assim fica bom para ti, faça como quiser


*/