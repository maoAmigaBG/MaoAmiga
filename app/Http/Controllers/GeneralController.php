<?php

namespace App\Http\Controllers;

use App\Models\Ong;
use App\Models\Post;
use Inertia\Inertia;
use App\Models\Membro;
use App\Models\Campanha;
use App\Models\Post_photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller {

    function index() {
        return Inertia::render('Home', [
            "posts" => Post::getWithLikes()->limit(20)->get(),
            "ranking" => Membro::ranking(),
            "campaigns" => Campanha::orderByDesc('created_at')->limit(5)->get()
        ]);
    }
    function about() {
        return Inertia::render('Sobre',[
            "ranking" => Membro::ranking(),
            "campaigns" => Campanha::orderByDesc('created_at')->limit(5)->get()
        ]);
    }
}
