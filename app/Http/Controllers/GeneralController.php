<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeneralController extends Controller {
    function index() {
        return Inertia::render('Home');
    }
    function about() {
        return Inertia::render('Sobre');
    }
}
