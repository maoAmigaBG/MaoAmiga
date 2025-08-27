<?php

use App\Http\Controllers\Admin_requestController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\Comment_likeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Post_likeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\WebhookController;
use App\Http\Middleware\LoginVerifyer;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OngController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\GeneralController;
use App\Http\Middleware\HandleInertiaRequests;

Route::middleware(HandleInertiaRequests::class)->group(function () {
    Route::get('/', [GeneralController::class, 'index'])->name('index');
    Route::get('/sobre', [GeneralController::class, "about"])->name("about");

    Route::prefix("/ong")->group(function () {
        Route::get('/list', [OngController::class, "index"])->name("ong.index");
        Route::get('/map', [OngController::class, "map"])->name("ong.map");
        Route::get('/map_location/{lat}/{lng}', [OngController::class, "map_location"])->name("ong.map_location");
        Route::get('/profile/{ong}', [OngController::class, "page"])->name("ong.profile");
        Route::prefix("/contacts")->group(function () {
            Route::get('/create/{ong}', [ContactController::class, "create"])->name("contacts.create");
            Route::post('/store', [ContactController::class, "store"])->name("contacts.store");
            Route::get('/delete/{contato}', [ContactController::class, "destroy"])->name("contacts.destroy");
        });
        Route::middleware(LoginVerifyer::class)->group(function () {
            Route::get('/requests/{ong}', [Admin_requestController::class, "index"])->name("ong.requests");
            Route::get('/create', [OngController::class, "create"])->name("ong.create");
            Route::post('/store', [OngController::class, "store"])->name("ong.store");
            Route::get('/edit/{ong}', [OngController::class, "edit"])->name("ong.edit");
            Route::put('/update/{ong}', [OngController::class, "update"])->name("ong.update");
            Route::get('/destroy/{ong}', [OngController::class, "destroy"])->name("ong.destroy");
            Route::get('/report/{ong}', [ReportController::class, "create"])->name("ong.report");
            Route::post('/report', [ReportController::class, "store"])->name("ong.report.store");
        });
        Route::get('/adress_provider/{cep}', [OngController::class, "adress_provider"])->name("ong.adress_provider");
    });

    Route::prefix("/campaign")->group(function () {
        Route::get('/{campaign}', [CampaignController::class, "index"])->name("campaign.index");
        Route::middleware(LoginVerifyer::class)->group(function () {
            Route::get('/create/{ong}', [CampaignController::class, "create"])->name("campaign.create");
            Route::post('/store', [CampaignController::class, "store"])->name("campaign.store");
            Route::get('/edit/{ong}', [CampaignController::class, "edit"])->name("campaign.edit");
            Route::post('/update', [CampaignController::class, "update"])->name("campaign.update");
            Route::get('/delete/{campanha}', [CampaignController::class, "destroy"])->name("campaign.destroy");
        });
    });

    Route::prefix("/post")->group(function () {
        Route::get('/create/{ong}', [PostController::class, "create"])->name("post.create");
        Route::get('/edit/{ong}', [PostController::class, "edit"])->name("post.edit");
        Route::post('/store', [PostController::class, "store"])->name("post.store");
        Route::post('/update', [PostController::class, "update"])->name("post.update");
        Route::get('/delete/{post}', [PostController::class, "destroy"])->name("post.destroy");
        Route::post('/like/{post}', [Post_likeController::class, "create"])->name("post.like");
        Route::delete('/deslike/{post_like}', [Post_likeController::class, "destroy"])->name("post.deslike");
    })->middleware(LoginVerifyer::class);

    Route::prefix('/comment')->group(function () {
        Route::post('/store', [CommentController::class, "store"])->name('comment.store');
        Route::post('/delete/{comment}', [CommentController::class, "destroy"])->name('comment.delete');
        Route::post('/toggle_like/{comment}', [Comment_likeController::class, "toggle"])->name('comment.like');
        Route::delete('/toggle_like/{comment_like}', [Comment_likeController::class, "unlike"])->name('comment.unlike');
    })->middleware(LoginVerifyer::class);

    Route::prefix("/donation")->middleware(LoginVerifyer::class)->group(function () {
        Route::post('/store', [DonationController::class, "store"])->name("donation.store"); //store the payment
        Route::get('/status/{stripe_payment_intent_id}', [DonationController::class, "status"])->name("donation.status"); //check from frontend to see when the payment has the status "succeeded"
        Route::get('/mail', [DonationController::class, "mail_test"])->name("donation.status"); //check from frontend to see when the payment has the status "succeeded"
    });
    Route::post('stripe/webhook', [WebhookController::class, 'handleWebhook'])->name('stripe.webhook');
});


Route::middleware(HandleInertiaRequests::class)->prefix("/user")->group(function () {
    Route::middleware(LoginVerifyer::class)->group(function () {
        Route::get("/profile/{user}/edit", [UserController::class, "edit_profile"])->name("user.editprofile");
        Route::post("/update", [UserController::class, "update"])->name("user.update");
        Route::get("/delete/{user}", [UserController::class, "destroy"])->name("user.delete");
        Route::prefix("/relations")->group(function () {
            Route::get("/edit/{user}", [MemberController::class, "edit"])->name("relations.edit");
            Route::post("/update", [MemberController::class, "update"])->name("relations.update");
            Route::get("/request_aprove/{user}", [MemberController::class, "request_aprove"])->name("relations.request_aprove");
            Route::get("/destroy/{user}", [MemberController::class, "destroy"])->name("relations.destroy");
            Route::get("/restore/{user}", [MemberController::class, "restore"])->name("relations.restore");
            Route::get("/request/create/{ong}", [Admin_requestController::class, "create"])->name("relations.create");
            Route::get("/request/destroy/{admin_pedido}", [Admin_requestController::class, "destroy"])->name("relations.destroy");
        });
    });
    Route::get("/login/{redirect?}/{data_list?}", [UserController::class, "login"])->name("login");
    Route::get("/logon", [UserController::class, "logon"])->name("logon");
    Route::get("/profile/{user}", [UserController::class, "profile"])->name("user.profile");
    Route::get("/relations/{user}", [MemberController::class, "ong_relations"])->name("user.relations");
    Route::get("/relations/trash", [MemberController::class, "trash"])->name("relations.trash");
});

Route::prefix("/auth")->group(function () {
    Route::post("/login", [UserController::class, "auth_login"])->name("auth.login");
    Route::post("/logon", [UserController::class, "auth_logon"])->name("auth.logon");
    Route::get("/logout", [UserController::class, "logout"])->name("auth.logout");
});