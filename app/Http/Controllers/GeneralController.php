<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Member;
use App\Models\Ong;
use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller {

    function index() {
        $posts = Post::getWithLikes()->paginate(10);

        return Inertia::render('Home', [
            "posts" => $posts->items(),
            "nextPageUrl" => $posts->nextPageUrl(),
            "login_checked" => Auth::check(),
            "ranking" => Member::ranking(),
            "campaigns" => Campaign::orderByDesc('created_at')->limit(5)->get()
        ]);
    }
    function about() {
        return Inertia::render('Sobre',[
            "ranking" => Member::ranking(),
            "campaigns" => Campaign::orderByDesc('created_at')->limit(5)->get()
        ]);
    }
}
