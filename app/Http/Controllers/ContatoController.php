<?php

namespace App\Http\Controllers;

use App\Models\Ong;
use App\Models\Membro;
use App\Models\Contato;
use App\Models\Campanha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ContatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Ong $ong) {
        if (Gate::denies("create", $ong)) {
            return redirect()->route("ong.contacts", [
                "ong" => $ong->id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar este perfil"
            ]);
        }
        $possible_contacts = ["Telefone","Celular","Email","Website","Facebook","Instagram","Twitter","LinkedIn","WhatsApp","Telegram","Fax","YouTube","TikTok","Outros"];
        $contacts_list = Contato::where("ong_id", $ong->id)->get();
        foreach ($contacts_list as $contact) {
            $value = array_search($contact["tipo"], $possible_contacts);
            if ($value) {
                unset($possible_contacts[$value]);
            }
        }
        $possible_contacts = array_values($possible_contacts);
        return [
            "contacts_list" => $possible_contacts,
            "ong_id" => $ong->id,
            "ranking" => Membro::ranking(),
            "campaigns" => Campanha::orderByDesc('created_at')->limit(5)->get()
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request_data = $request->validate([
            "nome" => ["required"],
            "tipo" => ["required"],
            "ong_id" => ["required", "exists:ongs,id"],
        ]);
        $ong = Ong::where("id", $request_data["ong_id"])->first();
        if (Gate::denies("create", $ong)) {
            return redirect()->route("ong.contacts", [
                "ong" => $ong->id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar este perfil"
            ]);
        }
        Contato::create($request_data);
        return redirect()->route("ong.contacts", [
            "ong" => $ong->id,
        ])->with([
            "Sucesso" => "Contato inserido com sucesso",
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
    public function destroy(Contato $contato) {
        $ong = Ong::where("id", $contato["ong_id"])->first();
        if (Gate::denies("delete", $contato)) {
            return redirect()->route("ong.contacts", [
                "ong" => $ong->id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar este perfil"
            ]);
        }
        $contato->delete();
        return redirect()->route("ong.contacts", [
            "ong" => $ong->id,
        ])->with([
            "Sucesso" => "Contato excluído com sucesso",
        ]);
    }
}
