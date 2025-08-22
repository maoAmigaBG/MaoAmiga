<?php

namespace App\Http\Controllers;

use App\Models\Ong;
use App\Models\Member;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Models\Members_donation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\CampaignRequest;
use Illuminate\Support\Facades\Storage;

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
        $request_data["foto"] = $request->file('foto')->store('campaigns', 'public');
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
        if ($request->hasFile('foto')) {
            if (Storage::disk('public')->exists($campaign->foto)) {
                Storage::disk('public')->delete($campaign->foto);
            }
            $path = $request->file('foto')->store('ongs', 'public');
            $request_data['foto'] = $path;
        } else {
            $request_data['foto'] = $campaign->foto;
        }
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
        Storage::disk('public')->delete($campaign->foto);
        $campaign->delete();
        return redirect()->route("ong.profile", [
            "ong" => $ong_id,
        ])->with([
            "Sucesso" => "Campanha excluída com sucesso",
        ]);
    }
}
