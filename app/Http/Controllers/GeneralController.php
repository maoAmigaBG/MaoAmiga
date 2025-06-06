<?php

namespace App\Http\Controllers;

use App\Models\Membro;
use App\Models\Ong;
use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeneralController extends Controller {
    function index() {
        return Inertia::render('Home', [
            "posts" => Post::orderBy("created_at", "asc")->limit(20)->get(),
            "ongs" => Ong::orderBy("created_at", "asc")->limit(20)->get(),
            "ranking" => Membro::ranking(),
        ]);
    }
    function about() {
        return Inertia::render('Sobre');
    }
}
