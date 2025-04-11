<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

abstract class Controller {
    public function authorization($level) {
        if (Auth::user()->level != $level) {
            redirect("/"); //maybe we pass the redirect path as a parameter too
        }
    }
}
