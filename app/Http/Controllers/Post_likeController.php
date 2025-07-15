<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Membro;
use App\Models\Campanha;
use App\Models\Post_like;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Post_likeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Post $post) {
        if (!Auth::check()) {
            return [
                "like_id" => 0,
            ];
        }
        $like = Post_like::create([
            "user_id" => Auth::user()->id,
            "post_id" => $post->id,
        ]);
        
        return response()->json([ 'like_id' => $like->id ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post_like $post_like) {
        $post_like->delete();
    }
}
