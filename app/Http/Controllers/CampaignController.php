<?php

namespace App\Http\Controllers;

use App\Models\Membros_doacoe;
use App\Models\Ong;
use App\Models\Campanha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CampaignController extends Controller {
    public function index(Campanha $campanha) {
        return [
            "campaign" => $campanha,
            "ong" => Ong::where("id", $campanha->ong_id)->get(),
            "donate_amount" => Membros_doacoe::selectRaw("SUM(doacao) as donation_amount")->where("campanha_id", $campanha->id)->get(),
        ];
    }
    public function create() {
        //
    }
    public function store(Request $request) {
        //
    }
    public function show(string $id) {
        //
    }
    public function edit(string $id) {
        //
    }
    public function update(Request $request, string $id) {
        //
    }
    public function destroy(string $id) {
        //
    }
}
