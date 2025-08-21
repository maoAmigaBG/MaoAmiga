<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Models\Post;
use App\Models\Comment;
use Inertia\Inertia;


class CommentController extends Controller
{

    public function store(CommentRequest $request)
    {
        $post = Post::find($request->post_id);

        $commentData = [
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'content' => $request->content
        ];

        $post->comments()->create($commentData);

        return redirect()->back(); 
    }

    public function update (CommentRequest $request, Comment $comment) {
        $this->authorize('update', $comment);

        $comment->update($request->validated());

        return redirect()->back()->with('sucesso', 'Comentário alterado com sucesso.');
    }

    public function destroy(Comment $comment) {
        $this->authorize('delete', $comment);

        $comment->delete();
        return back();
    }

}
