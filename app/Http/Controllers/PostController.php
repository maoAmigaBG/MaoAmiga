<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Ong;
use App\Models\Post;
use App\Models\Membro;
use App\Models\Campanha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
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
    public function create(Ong $ong) {
        if (Gate::denies("create", $ong)) {
            return redirect()->route("ong.profile", [
                "ong" => $ong->id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar esta ong"
            ]);
        }
        return [
            "ong_id" => $ong->id,
            "ranking" => Membro::ranking(),
            "campaigns" => Campanha::orderByDesc('created_at')->limit(5)->get()
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $ong = Ong::where("id", $request["ong_id"])->first();
        if (Gate::denies("create", $ong)) {
            return redirect()->route("ong.profile", [
                "ong" => $ong->id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar esta ong"
            ]);
        }
        $request_data = $request->validated();
        Post::create($request_data);
        return redirect()->route("ong.posts", [
            "ong" => $ong->id,
        ]);
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
    public function edit(Post $post) {
        if (Gate::denies("update", $post)) {
            return redirect()->route("ong.profile", [
                "ong" => $post->ong_id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar este post"
            ]);
        }
        return [
            "post" => $post,
            "ong" => Ong::find($post->ong_id),
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request) {
        $post = Post::find($request["id"]);
        if (Gate::denies("update", $post)) {
            return redirect()->route("ong.profile", [
                "ong" => $post->ong_id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar este post"
            ]);
        }
        $request_data = $request->validated();
        $post->update($request_data);
        return redirect()->route("ong.profile", [
            "ong" => $post->ong_id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $ong = Ong::where("id", $post["ong_id"])->first();
        if (Gate::denies("delete", $ong)) {
            return redirect()->route("ong.profile", [
                "ong" => $ong->id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar este post"
            ]);
        }
        $post->delete();
        return redirect()->route("ong.posts", [
            "ong" => $ong->id,
            "ranking" => Membro::ranking(),
            "campaigns" => Campanha::orderByDesc('created_at')->limit(5)->get()
        ]);
    }
}
