<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {
    public function insert_post(Request $request) {
        $request_data = $request->validate([
            "title" => ["required"],
            "body" => ["required"],
        ]);
        $request_data["title"] = strip_tags($request_data["title"]);
        $request_data["body"] = strip_tags($request_data["body"]);
        $request_data["user_id"] = Auth::id();
        Post::create($request_data);
        return redirect("/");
    }
    public function edit_post(Post $post) {
        if (Auth::user()->id !== $post["user_id"]) { // dont allow to edit other users post
            return redirect("/");
        }
        return view("edit-post", ["post" => $post]);
    }
    public function update_post(Post $post, Request $request) {
        if (Auth::user()->id !== $post["user_id"]) { // dont allow to edit other users post
            return redirect("/");
        }
        $request_data = $request->validate([
            "title" => ["required"],
            "body" => ["required"]
        ]);
        $request_data["title"] = strip_tags($request_data["title"]);
        $request_data["body"] = strip_tags($request_data["body"]);
        $post->update($request_data);
        return redirect("/");
    }
    public function delete_post(Post $post) {
        if (Auth::user()->id === $post["user_id"]) { // dont allow to delete other users post
            $post->delete();
        }
        return redirect("/");
    }
}
