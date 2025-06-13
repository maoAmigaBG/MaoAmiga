<?php

namespace App\Http\Controllers;

use App\Models\Admin_pedido;
use Carbon\Carbon;
use App\Models\Ong;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Membro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class MembroController extends Controller
{
    public function ong_relations(User $user) {
        $relations = Membro::select(['ongs.id','ongs.nome', "ong_types.nome as type", 'ongs.foto', 'membros.created_at'])
            ->join('ongs', 'ongs.id', '=', 'membros.ong_id')
            ->join('ong_types', 'ong_types.id', '=', 'ongs.ong_type_id')
            ->where('user_id', $user->id)
            ->get();
        return Inertia::render('Profile/User/OngsRelations', [
            "user" => $user,
            "ong_relations" => $relations->isEmpty() ? null : $relations,
        ]);
    }
    public function edit($membro_id) {
        $membro = Membro::where("id", $membro_id)->first();
        if (Gate::denies("update", $membro)) {
            return redirect()->route("user.relations", [
                "user" => Auth::user(),
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar este perfil"
            ]);
        }
        return [
            "member" => $membro,
            "ong" => Ong::select(["ongs.id","ongs.nome","ongs.subtitulo","ongs.descricao","ongs.lat","ongs.lng","ongs.endereco","ongs.banner","ongs.foto","ong_types.nome as type"])->join("ong_types", "ong_types.id", "=", "ongs.ong_type_id")->get(),
            "user" => User::where("id", $membro->user_id)->first(),
        ];
    }
    public function update(Request $request) {
        $membro = Membro::where("id", $request->id)->first();
        if (Gate::denies("update", $membro)) {
            return redirect()->route("user.relations", [
                "user" => Auth::user(),
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar este perfil"
            ]);
        }
        $membro->update($request->all());
        return redirect()->route("user.relations", [
            "user" => $membro->user_id
        ]);
    }
    public function request_aprove(Membro $membro) {
        if (Gate::denies("admin", $membro)) {
            return redirect()->route("relations.edit", [
                "user" => Auth::user()->id
            ]);
        }
        $admin_pedido = Admin_pedido::where("membro_id", $membro->id)->where("ong_id", $membro->ong_id)->first();
        $admin_pedido->delete();
        $membro->update([
            "admin" => true
        ]);
        return redirect()->route("ong.requests", [
            "ong" => $membro->ong_id,
        ]);
    }
    public function destroy(Membro $membro) {
        if (Gate::denies("delete", $membro)) {
            return redirect()->route("user.relations", [
                "user" => Auth::user(),
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar este perfil"
            ]);
        }
        $membro->delete();
        return redirect()->route("user.relations", [
            "user" => $membro->user_id,
        ]);
    }
    public function restore(Membro $membro) {
        if (Gate::denies("delete", $membro)) {
            return redirect()->route("user.relations", [
                "user" => Auth::user(),
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar este perfil"
            ]);
        }
        $membro->restore();
        return redirect()->route("user.relations", [
            "user" => $membro->user_id,
        ]);
    }
    public function trash() {
        return [
            "members" => Membro::onlyTrashed()->where("user_id", Auth::user()->id)->get(),
        ];
    }
}
