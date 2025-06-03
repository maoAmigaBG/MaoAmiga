<?php

use App\Http\Controllers\GeneralController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\HandleInertiaRequests;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OngController;

Route::middleware(HandleInertiaRequests::class)->group(function () {
    Route::get('/', [GeneralController::class,'index'])->name('index');
    Route::get('/sobre', [GeneralController::class, "about"])->name("about");

    Route::prefix("/ong")->group(function() {
        Route::get('/list', [OngController::class, "index"])->name("ong.index");
        Route::get('/map', [OngController::class, "map"])->name("ong.map");
        Route::get('/page/{ong}', [OngController::class, "page"])->name("ong.page");
    });

});


Route::middleware(HandleInertiaRequests::class)->prefix("/user")->group(function() {
    Route::get("/login", [UserController::class, "login"])->name("login");
    Route::get("/logon", [UserController::class, "logon"])->name("logon");
    Route::get("/profile/{user}", [UserController::class, "profile"])->name("user.profile");
});

Route::prefix("/auth")->group(function() {
    Route::post("/login", [UserController::class, "auth_login"])->name("auth.login");
    Route::post("/logon", [UserController::class, "auth_logon"])->name("auth.logon");
    Route::get("/logout", [UserController::class, "logout"])->name("auth.logout");
});

//alessandro, essas são as rotas de authentication (deixei junto os uses de controllers):

/*

Route::get("/", [OngController::class, "index"])->name("index"); // não sei se assim fica bom para ti, faça como quiser


*/