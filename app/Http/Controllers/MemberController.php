<?php

namespace App\Http\Controllers;

use App\Models\Admin_request;
use App\Models\Campaign;
use App\Models\Member;
use Carbon\Carbon;
use App\Models\Ong;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class MemberController extends Controller
{
    public function ong_relations(User $user) {
        $relations = Member::select(['ongs.id','ongs.nome', "ong_types.nome as type", 'ongs.foto', 'members.created_at'])
            ->join('ongs', 'ongs.id', '=', 'members.ong_id')
            ->join('ong_types', 'ong_types.id', '=', 'ongs.ong_type_id')
            ->where('user_id', $user->id)
            ->get();
        return Inertia::render('Profile/User/OngsRelations', [
            "user" => $user,
            "ong_relations" => $relations->isEmpty() ? null : $relations,
            "ranking" => Member::ranking(),
            "campaigns" => Campaign::orderByDesc('created_at')->limit(5)->get()
        ]);
    }
    public function edit($member_id) {
        $member = Member::find($member_id);
        if (Gate::denies("update", $member)) {
            return redirect()->route("user.relations", [
                "user" => Auth::user(),
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar este perfil"
            ]);
        }
        return [
            "member" => $member,
            "ong" => Ong::select(["ongs.id","ongs.nome","ongs.subtitulo","ongs.descricao","ongs.lat","ongs.lng","ongs.endereco","ongs.banner","ongs.foto","ong_types.nome as type"])->join("ong_types", "ong_types.id", "=", "ongs.ong_type_id")->get(),
            "user" => $member->user()->first(),
            "ranking" => Member::ranking(),
            "campaigns" => Campaign::orderByDesc('created_at')->limit(5)->get()
        ];
    }
    public function update(Request $request) {
        $member = Member::find($request->id);
        if (Gate::denies("update", $member)) {
            return redirect()->route("user.relations", [
                "user" => Auth::user(),
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar este perfil"
            ]);
        }
        $member->update($request->all());
        return redirect()->route("user.relations", [
            "user" => $member->user_id,
        ])->with([
            "Sucesso" => "Membresia editada com sucesso",
        ]);
    }
    public function request_aprove(Member $member) {
        if (Gate::denies("admin", $member)) {
            return redirect()->route("relations.edit", [
                "user" => Auth::user()->id,
            ]);
        }
        $admin_request = Admin_request::where("member_id", $member->id)->where("ong_id", $member->ong_id)->first();
        $admin_request->delete();
        $member->update([
            "admin" => true
        ]);
        return redirect()->route("ong.requests", [
            "ong" => $member->ong_id,
        ])->with([
            "Sucesso" => "Pedido aceito com sucesso",
        ]);
    }
    public function destroy(Member $member) {
        if (Gate::denies("delete", $member)) {
            return redirect()->route("user.relations", [
                "user" => Auth::user(),
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar este perfil"
            ]);
        }
        $member->delete();
        return redirect()->route("user.relations", [
            "user" => $member->user_id,
        ])->with([
            "Sucesso" => "Membresia excluída com sucesso",
        ]);
    }
    public function restore(Member $member) {
        if (Gate::denies("delete", $member)) {
            return redirect()->route("user.relations", [
                "user" => Auth::user(),
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar este perfil"
            ]);
        }
        $member->restore();
        return redirect()->route("user.relations", [
            "user" => $member->user_id,
        ])->with([
            "Sucesso" => "Membresia restaurada com sucesso",
        ]);
    }
    public function trash() {
        return [
            "members" => Member::onlyTrashed()->where("user_id", Auth::user()->id)->get(),
            "ranking" => Member::ranking(),
            "campaigns" => Campaign::orderByDesc('created_at')->limit(5)->get()
        ];
    }
}
