<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return view("index");
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
Route::post("/auth_logon", [UserController::class, "register"]);
