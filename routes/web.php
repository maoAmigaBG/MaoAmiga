<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OngController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MembroController;
use App\Http\Controllers\GeneralController;
use App\Http\Middleware\HandleInertiaRequests;

Route::middleware(HandleInertiaRequests::class)->group(function () {
    Route::get('/', [GeneralController::class,'index'])->name('index');
    Route::get('/sobre', [GeneralController::class, "about"])->name("about");

    Route::prefix("/ong")->group(function() {
        Route::get('/list', [OngController::class, "index"])->name("ong.index");
        Route::get('/map', [OngController::class, "map"])->name("ong.map");
        Route::get('/page/{ong}', [OngController::class, "page"])->name("ong.page");
        Route::get('/members/{ong}', [OngController::class, "members"])->name("ong.members");
        Route::get('/posts/{ong}', [OngController::class, "posts"])->name("ong.posts");
        Route::get('/campaigns/{ong}', [OngController::class, "campaigns"])->name("ong.campaigns");
        Route::get('/contacts/{ong}', [OngController::class, "contacts"])->name("ong.contacts");
    });

});

Route::middleware(HandleInertiaRequests::class)->prefix("/user")->group(function() {
    Route::get("/login", [UserController::class, "login"])->name("login");
    Route::get("/logon", [UserController::class, "logon"])->name("logon");
    Route::get("/profile/{user}", [UserController::class, "profile"])->name("user.profile");
    Route::get("/relations/{user}", [MembroController::class, "ong_relations"])->name("user.relations");
});

Route::prefix("/auth")->group(function() {
    Route::post("/login", [UserController::class, "auth_login"])->name("auth.login");
    Route::post("/logon", [UserController::class, "auth_logon"])->name("auth.logon");
    Route::get("/logout", [UserController::class, "logout"])->name("auth.logout");
});