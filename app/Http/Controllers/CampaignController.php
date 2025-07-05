<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignRequest;
use App\Models\Ong;
use App\Models\Membro;
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
            "ranking" => Membro::ranking(),
            "campaigns" => Campanha::orderByDesc('created_at')->limit(5)->get()
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
            "ong_id" => $ong->id,
            "ranking" => Membro::ranking(),
            "campaigns" => Campanha::orderByDesc('created_at')->limit(5)->get()
        ];
    }
    public function store(CampaignRequest $request) {
        $ong = Ong::where("id", $request["ong_id"]);
        if (Gate::denies("create", $ong)) {
            return redirect()->route("ong.profile", [
                "ong" => $ong->id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar esta ong"
            ]);
        }
        $request_data = $request->validated();
        $ong = Campanha::create($request_data);
        return redirect()->route("ong.profile", [
            "ong" => $ong->id,
            "ranking" => Membro::ranking(),
            "campaigns" => Campanha::orderByDesc('created_at')->limit(5)->get()
        ])->with([
            "Sucesso" => "Campanha inserida com sucesso",
        ]);
    }
    public function show(string $id) {
        //
    }
    public function edit(Campanha $campanha) {
        if (Gate::denies("update", $campanha)) {
            return redirect()->route("campaign.index", [
                "campanha" => $campanha->id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para alterar esta campanha"
            ]);
        }
        return [
            "ong" => Ong::find($campanha->id),
            "campanha" => $campanha,
        ];
    }
    public function update(CampaignRequest $request) {
        $campanha = Campanha::find($request["id"]);
        if (Gate::denies("update", $campanha)) {
            return redirect()->route("campaign.index", [
                "campanha" => $campanha->id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para alterar esta campanha"
            ]);
        }
        $request_data = $request->validated();
        $campanha->update($request_data);
        return redirect()->route("campaign.index", [
            "campanha" => $campanha->id,
        ])->with([
            "Sucesso" => "Campanha editada com sucesso",
        ]);
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
        ])->with([
            "Sucesso" => "Campanha excluída com sucesso",
        ]);
    }
}
