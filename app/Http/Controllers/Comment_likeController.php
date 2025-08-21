<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class Comment_likeController extends Controller
{
    public function toggle(Comment $comment) {
        $user = auth()->user();

        if ($comment->isLikedBy($user)) {
            $comment->likes()->where('user_id', $user->id)->delete();
        } else {
            $comment->likes()->create([
                'user_id' => $user->id,
                'comment_id' => $comment->id
            ]);
        }

        return back();
    }
}
