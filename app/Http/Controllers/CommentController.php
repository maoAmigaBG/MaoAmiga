<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class CommentController extends Controller
{

    public function store(CommentRequest $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'You must be logged in to comment.'], 401);
        }

        $post = Post::findOrFail($request->post_id);

        $commentData = [
            'user_id' => $user->id,
            'post_id' => $post->id,
            'comment_content' => $request->comment_content
        ];

        $post->comments()->create($commentData);

        return redirect()->back(); 
    }
    public function destroy(Comment $comment) {
        $this->authorize('delete', $comment);

        $comment->delete();
        return back();
    }

}
