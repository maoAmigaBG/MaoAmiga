<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class Comment_likeController extends Controller
{
    public function toggle(Comment $comment)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'User not authenticated.'], 401);
        }

        $like = $comment->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
        } else {
            $comment->likes()->create(['user_id' => $user->id]);
        }

        return response()->json(['message' => 'Success']);
    }
}
