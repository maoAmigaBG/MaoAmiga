<?php

namespace App\Http\Controllers;

use App\Models\Ong;
use App\Models\Membro;
use App\Models\Admin_pedido;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Admin_pedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Ong $ong) {
        if (empty(Membro::where("ong_id", $ong->id)->where("user_id", Auth::user()->id)->where("admin", true)->first())) {
            return redirect()->back()->withErrors([
                "Acesso negado" => "Você não possui permissão para acessar esta página",
            ]);
        }
        $admin_pedidos = Admin_pedido::where("ong_id", $ong->id)->get();
        return [
            "ong" => $ong,
            "pedidos" => $admin_pedidos,
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Ong $ong) {
        $member = Membro::where("ong_id", $ong->id)->where("user_id", Auth::user()->id)->first();
        Admin_pedido::create([
            "ong_id" => $ong->id,
            "membro_id" => $member->i,
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
    public function destroy(string $id)
    {
        //
    }
}
