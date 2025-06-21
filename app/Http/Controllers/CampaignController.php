<?php

namespace App\Http\Controllers;

use App\Models\Ong;
use App\Models\Campanha;
use Illuminate\Http\Request;
use App\Models\Membros_doacoe;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class CampaignController extends Controller {
    public function index(Campanha $campanha) {
        return [
            "campaign" => $campanha,
            "ong" => Ong::where("id", $campanha->ong_id)->get(),
            "donate_amount" => Membros_doacoe::selectRaw("SUM(doacao) as donation_amount")->where("campanha_id", $campanha->id)->get(),
        ];
    }
    public function create(Ong $ong) {
        if (Gate::denies("create", $ong)) {
            return redirect()->route("ong.profile", [
                "ong" => $ong->id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar esta ong"
            ]);
        }
        return [
            "ong_id" => $ong->id
        ];
    }
    public function store(Request $request) {
        $ong = Ong::where("id", $request["ong_id"]);
        if (Gate::denies("create", $ong)) {
            return redirect()->route("ong.profile", [
                "ong" => $ong->id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar esta ong"
            ]);
        }
        $request_data = $request->validate([
            'nome' => ["required"],
            'tipo' => ["required"],
            'descricao' => ["required"],
            'materiais' => ["nullable"],
            'meta' => ["nullable"],
            'foto' => ["nullable", 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'ong_id' => ["required"],
        ]);
        Campanha::create($request_data);
    }
    public function show(string $id) {
        //
    }
    public function edit(string $id) {
        // creio que não precisa
    }
    public function update(Request $request, string $id) {
        //
    }
    public function destroy(string $id) {
        $campanha = Campanha::where("id", $id)->first();
        if (Gate::denies("delete", $campanha)) {
            return redirect()->route("campaign.index", [
                "campanha" => $campanha->id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar esta campanha"
            ]);
        }
        $ong_id = $campanha["ong_id"];
        $campanha->delete();
        return redirect()->route("ong.profile", [
            "ong" => $ong_id,
        ]);
    }
}
