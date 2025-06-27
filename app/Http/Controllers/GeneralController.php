<?php

namespace App\Http\Controllers;

use App\Models\Membro;
use App\Models\Ong;
use App\Models\Post;
use App\Models\Post_photo;
use App\Models\Campanha;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeneralController extends Controller {
    function index() {
        return Inertia::render('Home', [
            "posts" => Post::orderBy("created_at", "asc")->limit(20)->get(),
            "ranking" => Membro::ranking(),
            "campaigns" => Campanha::orderByDesc('created_at')->limit(5)->get()
        ]);
    }
    function about() {
        return Inertia::render('Sobre');
    }
}
