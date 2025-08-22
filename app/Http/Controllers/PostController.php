<?php

namespace App\Http\Controllers;

use App\Models\Ong;
use App\Models\Post;
use App\Models\Member;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

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
            "ranking" => Member::ranking(),
            "campaigns" => Campaign::orderByDesc('created_at')->limit(5)->get()
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
        $request_data["foto"] = $request->file('foto')->store('posts', 'public');
        Post::create($request_data);
        return redirect()->route("ong.posts", [
            "ong" => $ong->id,
        ])->with([
            "Sucesso" => "Post inserido com sucesso",
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
        if ($request->hasFile('foto')) {
            if (Storage::disk('public')->exists($post->foto)) {
                Storage::disk('public')->delete($post->foto);
            }
            $path = $request->file('foto')->store('ongs', 'public');
            $request_data['foto'] = $path;
        } else {
            $request_data['foto'] = $post->foto;
        }
        $post->update($request_data);
        return redirect()->route("ong.profile", [
            "ong" => $post->ong_id,
        ])->with([
            "Sucesso" => "Post editado com sucesso",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $ong = $post->ong()->first();
        if (Gate::denies("delete", $ong)) {
            return redirect()->route("ong.profile", [
                "ong" => $ong->id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar este post"
            ]);
        }
        Storage::disk('public')->delete($post->foto);
        $post->delete();
        return redirect()->route("ong.posts", [
            "ong" => $ong->id,
            "ranking" => Member::ranking(),
            "campaigns" => Campaign::orderByDesc('created_at')->limit(5)->get()
        ])->with([
            "Sucesso" => "Post excluído com sucesso",
        ]);
    }
}
