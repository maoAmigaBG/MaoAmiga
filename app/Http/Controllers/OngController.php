<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use App\Models\Membro;
use App\Models\Ong;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Campanha;
use App\Models\Ong_type;
use App\Models\Post;

class OngController extends Controller {
    function index() {
        return Inertia::render('Ong', [
            "ongs" => Ong::orderBy("created_at", "asc")
                ->limit(20)
                ->get(),
        ]);
    }
    function map() {
        return Inertia::render('Mapa');
    }
    public function page(Ong $ong) {
        return [
            "ong" => $ong,
            "ong_type" => Ong_type::where("id", $ong->ong_type_id)->get(),
            "members_amount" => Membro::members_amount($ong->id),
        ];
    }
    public function members(Ong $ong) {
        return [
            "ong" => $ong,
            "members" => Membro::select([ 'membros.id', 'membros.nivel', 'membros.anonimo', 'membros.user_id', 'membros.ong_id', ])
                ->selectRaw("SUM(doacao) as donate_amount")
                    ->join("membros_doacoes", "membros_doacoes.membro_id", "=", "membros.id")
                    ->where("membros.ong_id", $ong->id)
                    ->groupBy('membros.id', 'membros.nivel', 'membros.anonimo', 'membros.user_id', 'membros.ong_id')
                    ->orderByDesc("donate_amount")
                    ->get(),
            "members_amount" => Membro::members_amount($ong->id),
        ];
    }
    public function posts(Ong $ong) {
        return [
            "ong" => $ong,
            "posts" => Post::select(["posts.id", "posts.nome", "posts.descricao",])
                ->selectSub(function ($query) {
                    $query->from('post_likes')
                        ->selectRaw('COUNT(*)')
                        ->whereColumn('post_likes.post_id', 'posts.id');
                }, 'likes_num')
                ->selectRaw('GROUP_CONCAT(post_photos.nome) as photos')
                ->leftJoin("post_photos", "post_photos.post_id", "=", "posts.id")
                ->where("posts.ong_id", $ong->id)
                ->groupBy("posts.id", "posts.nome", "posts.descricao")
                ->orderByDesc("posts.created_at")
                ->get()
                ->map(function ($post) {
                    $post->photos = $post->photos ? explode(',', $post->photos) : [];
                    return $post;
                }),
        ];
    }
    public function campaigns(Ong $ong) {
        return [
            "ong" => $ong,
            "campaigns" => Campanha::select(["nome", "tipo", "descricao", "materiais", "meta", "foto", "ong_id"])
                ->selectRaw("SUM(doacao) as donation_amount")
                ->join("membros_doacoes", "membros_doacoes.campanha_id", "=", "campanhas.id")
                ->where("ong_id", $ong->id)
                ->groupBy("campanhas.id", "nome", "tipo", "descricao", "materiais", "meta", "foto", "ong_id")
                ->get(),
        ];
    }
    public function contacts(Ong $ong) {
        return [
            "ong" => $ong,
            "contacts" => Contato::where("ong_id", $ong->id)->get(),
        ];
    }
}