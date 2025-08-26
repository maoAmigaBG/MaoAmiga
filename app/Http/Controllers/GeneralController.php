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

class GeneralController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        $posts = Post::with([
            'ong',
            'comments' => function ($query) use ($user) {
                $query->with([
                    'user:id,name,foto',
                    'likes' => function ($query) use ($user) {
                        if ($user) {
                            $query->where('user_id', $user->id);
                        }
                    }
                ])
                    ->withCount('likes');
            },
            'likes' => function ($query) use ($user) {
                if ($user) {
                    $query->where('user_id', $user->id);
                }
            }
        ])
            ->withCount('likes as likes_count', 'comments as comments_count')
            ->withExists([
                'likes as liked' => function ($query) use ($user) {
                    if ($user) {
                        $query->where('user_id', $user->id);
                    }
                }
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $posts->getCollection()->transform(function ($post) {
            $post->comments->transform(function ($comment) {
                $comment->liked = $comment->likes->isNotEmpty();
                unset($comment->likes);
                return $comment;
            });
            return $post;
        });

        return Inertia::render('Home', [
            "posts" => $posts,
            "login_checked" => Auth::check(),
            "ranking" => Member::ranking(),
            "campaigns" => Campaign::orderByDesc('created_at')->limit(5)->get()
        ]);
    }

    function about()
    {
        return Inertia::render('Sobre', [
            "ranking" => Member::ranking(),
            "campaigns" => Campaign::orderByDesc('created_at')->limit(5)->get()
        ]);
    }
}
