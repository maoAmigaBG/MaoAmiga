<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignRequest;
use App\Models\Member;
use App\Models\Members_donation;
use App\Models\Ong;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class CampaignController extends Controller {
    public function index(Campaign $campaign) {
        return [
            "campaign" => $campaign,
            "ong" => Ong::where("id", $campaign->ong_id)->get(),
            "donate_amount" => Members_donation::selectRaw("SUM(doacao) as donation_amount")->where("campaign_id", $campaign->id)->get(),
            "ranking" => Member::ranking(),
            "campaigns" => Campaign::orderByDesc('created_at')->limit(5)->get()
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
            "ranking" => Member::ranking(),
            "campaigns" => Campaign::orderByDesc('created_at')->limit(5)->get()
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
        $ong = Campaign::create($request_data);
        return redirect()->route("ong.profile", [
            "ong" => $ong->id,
            "ranking" => Member::ranking(),
            "campaigns" => Campaign::orderByDesc('created_at')->limit(5)->get()
        ])->with([
            "Sucesso" => "Campanha inserida com sucesso",
        ]);
    }
    public function show(string $id) {
        //
    }
    public function edit(Campaign $campaign) {
        if (Gate::denies("update", $campaign)) {
            return redirect()->route("campaign.index", [
                "campaign" => $campaign->id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para alterar esta campanha"
            ]);
        }
        return [
            "ong" => Ong::find($campaign->id),
            "campaign" => $campaign,
        ];
    }
    public function update(CampaignRequest $request) {
        $campaign = Campaign::find($request["id"]);
        if (Gate::denies("update", $campaign)) {
            return redirect()->route("campaign.index", [
                "campaign" => $campaign->id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para alterar esta campanha"
            ]);
        }
        $request_data = $request->validated();
        $campaign->update($request_data);
        return redirect()->route("campaign.index", [
            "campaign" => $campaign->id,
        ])->with([
            "Sucesso" => "Campanha editada com sucesso",
        ]);
    }
    public function destroy(string $id) {
        $campaign = Campaign::where("id", $id)->first();
        if (Gate::denies("delete", $campaign)) {
            return redirect()->route("campaign.index", [
                "campaign" => $campaign->id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar esta campaign"
            ]);
        }
        $ong_id = $campaign["ong_id"];
        $campaign->delete();
        return redirect()->route("ong.profile", [
            "ong" => $ong_id,
        ])->with([
            "Sucesso" => "Campanha excluída com sucesso",
        ]);
    }
}
