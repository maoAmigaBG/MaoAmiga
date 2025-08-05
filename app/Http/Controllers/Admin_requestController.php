<?php

namespace App\Http\Controllers;

use App\Models\Ong;
use App\Models\Member;
use App\Models\Admin_request;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Admin_requestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Ong $ong) {
        if (Gate::denies("view", $ong)) {
            return redirect()->route("ong.profile", [
                "ong" => $ong->id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para acessar esta página",
            ]);
        }
        return [
            "ong" => $ong,
            "requests" => $ong->admin_requests()->get(),
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Ong $ong) {
        if (Gate::denies("view", $ong)) {
            return redirect()->route("ong.profile", [
                "ong" => $ong->id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para realizar esta ação",
            ]);
        }
        $member = Member::where("ong_id", $ong->id)->where("user_id", Auth::user()->id)->first();
        Admin_request::create([
            "ong_id" => $ong->id,
            "membro_id" => $member->id,
        ]);
        return redirect()->route("relations.edit", [
            "user" => $member->user_id,
        ])->with([
            "Sucesso" => "Pedido enviado com sucesso"
        ]);
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
    public function destroy(Admin_request $admin_request) {
        $ong = Ong::where("id", $admin_request["ong_id"]);
        if (Gate::denies("delete", $admin_request)) {
            return redirect()->route("ong.profile", [
                "ong" => $ong->id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para realizar esta ação",
            ]);
        }
        $admin_request->delete();
        return redirect()->route("ong.profile", [
            "ong" => $ong->id,
        ]);
    }
}
