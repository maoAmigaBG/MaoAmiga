<?php

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
