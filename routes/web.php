<?php

use App\Http\Controllers\CampaignController;
use App\Http\Middleware\LoginVerifyer;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OngController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MembroController;
use App\Http\Controllers\GeneralController;
use App\Http\Middleware\HandleInertiaRequests;

Route::middleware(HandleInertiaRequests::class)->group(function () {
    Route::get('/', [GeneralController::class,'index'])->name('index');
    Route::get('/sobre', [GeneralController::class, "about"])->name("about")->middleware(LoginVerifyer::class);

    Route::prefix("/ong")->group(function() {
        Route::get('/list', [OngController::class, "index"])->name("ong.index");
        Route::get('/map', [OngController::class, "map"])->name("ong.map");
        Route::get('/map_location/{lat}/{lng}', [OngController::class, "map_location"])->name("ong.map_location");
        Route::get('/members/{ong}', [OngController::class, "members"])->name("ong.members");
        Route::get('/profile/{ong}', [OngController::class, "page"])->name("ong.profile");
        Route::get('/posts/{ong}', [OngController::class, "posts"])->name("ong.posts");
        Route::get('/campaigns/{ong}', [OngController::class, "campaigns"])->name("ong.campaigns");
        Route::get('/contacts/{ong}', [OngController::class, "contacts"])->name("ong.contacts");
    });
    Route::prefix("/campaign")->group(function() {
        Route::get('/page/{campanha}', [CampaignController::class, "index"])->name("campaign.index");
    });

});


Route::middleware(HandleInertiaRequests::class)->prefix("/user")->group(function() {
    Route::get("/login/{redirect?}", [UserController::class, "login"])->name("login");
    Route::get("/logon", [UserController::class, "logon"])->name("logon");
    Route::get("/profile/{user}", [UserController::class, "profile"])->name("user.profile");
    Route::get("/profile/{user}/edit", [UserController::class, "edit_profile"])->name("user.editprofile");
    Route::get("/relations/{user}", [MembroController::class, "ong_relations"])->name("user.relations");
    Route::get("/relations/destroy/{user}", [MembroController::class, "destroy"])->name("user.relations.destroy");
    Route::get("/relations/trash", [MembroController::class, "trash"])->name("user.relations.trash");
});

Route::prefix("/auth")->group(function() {
    Route::post("/login", [UserController::class, "auth_login"])->name("auth.login");
    Route::post("/logon", [UserController::class, "auth_logon"])->name("auth.logon");
    Route::get("/logout", [UserController::class, "logout"])->name("auth.logout");
});