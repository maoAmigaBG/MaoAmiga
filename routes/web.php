<?php

use App\Http\Controllers\Admin_pedidoController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\PostController;
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
    Route::get('/sobre', [GeneralController::class, "about"])->name("about");

    Route::prefix("/ong")->group(function() {
        Route::get('/list', [OngController::class, "index"])->name("ong.index");
        Route::get('/map', [OngController::class, "map"])->name("ong.map");
        Route::get('/map_location/{lat}/{lng}', [OngController::class, "map_location"])->name("ong.map_location");
        Route::get('/profile/{ong}', [OngController::class, "page"])->name("ong.profile");
        Route::prefix("/contacts")->group(function() {
            Route::get('/create/{ong}', [ContatoController::class, "create"])->name("contacts.create");
            Route::post('/store', [ContatoController::class, "store"])->name("contacts.store");
            Route::get('/delete/{contato}', [ContatoController::class, "destroy"])->name("contacts.destroy");
        });
        Route::middleware(LoginVerifyer::class)->group(function () {
            Route::get('/requests/{ong}', [Admin_pedidoController::class, "index"])->name("ong.requests");
            Route::get('/create', [OngController::class, "create"])->name("ong.create");
            Route::post('/store', [OngController::class, "store"])->name("ong.store");
            Route::get('/edit/{ong}', [OngController::class, "edit"])->name("ong.edit");
            Route::post('/update', [OngController::class, "update"])->name("ong.update");
            Route::get('/destroy/{ong}', [OngController::class, "destroy"])->name("ong.destroy");
        });
        Route::get('/adress_provider/{cep}', [OngController::class, "adress_provider"])->name("ong.adress_provider");
    });
    Route::prefix("/campaign")->group(function() {
        Route::get('/page/{campanha}', [CampaignController::class, "index"])->name("campaign.index");
        Route::middleware(LoginVerifyer::class)->group(function () {
            Route::get('/create/{ong}', [CampaignController::class, "create"])->name("campaign.create");
            Route::post('/store', [CampaignController::class, "store"])->name("campaign.store");
            Route::get('/delete/{campanha}', [CampaignController::class, "destroy"])->name("campaign.destroy");
        });
    });
    Route::prefix("/post")->group(function() {
        Route::get('/create/{ong}', [PostController::class, "create"])->name("post.create");
        Route::post('/store', [PostController::class, "store"])->name("post.store");
        Route::get('/delete/{post}', [PostController::class, "destroy"])->name("post.destroy");
        Route::get('/like/{post}', [PostController::class, "create"])->name("post.like");
        Route::get('/deslike/{post_like}', [PostController::class, "destroy"])->name("post.deslike");
    })->middleware(LoginVerifyer::class);

});


Route::middleware(HandleInertiaRequests::class)->prefix("/user")->group(function() {
    Route::middleware(LoginVerifyer::class)->group(function() {
        Route::get("/profile/{user}/edit", [UserController::class, "edit_profile"])->name("user.editprofile");
        Route::post("/update", [UserController::class, "update"])->name("user.update");
        Route::get("/delete/{user}", [UserController::class, "destroy"])->name("user.delete");
        Route::prefix("/relations")->group(function() {
            Route::get("/edit/{user}", [MembroController::class, "edit"])->name("relations.edit");
            Route::post("/update", [MembroController::class, "update"])->name("relations.update");
            Route::get("/request_aprove/{user}", [MembroController::class, "request_aprove"])->name("relations.request_aprove");
            Route::get("/destroy/{user}", [MembroController::class, "destroy"])->name("relations.destroy");
            Route::get("/restore/{user}", [MembroController::class, "restore"])->name("relations.restore");
            Route::get("/request/create/{ong}", [Admin_pedidoController::class, "create"])->name("relations.create");
            Route::get("/request/destroy/{admin_pedido}", [Admin_pedidoController::class, "destroy"])->name("relations.destroy");
        });
    });
    Route::get("/login/{redirect?}/{data_list?}", [UserController::class, "login"])->name("login");
    Route::get("/logon", [UserController::class, "logon"])->name("logon");
    Route::get("/profile/{user}", [UserController::class, "profile"])->name("user.profile");
    Route::get("/relations/{user}", [MembroController::class, "ong_relations"])->name("user.relations");
    Route::get("/relations/trash", [MembroController::class, "trash"])->name("relations.trash");
});

Route::prefix("/auth")->group(function() {
    Route::post("/login", [UserController::class, "auth_login"])->name("auth.login");
    Route::post("/logon", [UserController::class, "auth_logon"])->name("auth.logon");
    Route::get("/logout", [UserController::class, "logout"])->name("auth.logout");
});