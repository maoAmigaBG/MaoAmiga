<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Post_like;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class Post_likeController extends Controller
{

    public function create(Post $post)
{
    if (!Auth::check()) {
        return Inertia::location('/user/login');
    }
    $like = Post_like::firstOrCreate([
        "user_id" => Auth::user()->id,
        "post_id" => $post->id,
    ]);
    // Return the like object with its ID
    return response()->json(['like' => $like]);
}

    public function destroy(Post_like $post_like)
    {
        $post_like->delete();
    }
}