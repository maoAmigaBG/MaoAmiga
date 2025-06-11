<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Membro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MembroController extends Controller
{
    public function ong_relations(User $user) {
        $relations = Membro::select(['ongs.id','ongs.nome', "ong_types.nome as type", 'ongs.foto', 'membros.created_at'])
            ->join('ongs', 'ongs.id', '=', 'membros.ong_id')
            ->join('ong_types', 'ong_types.id', '=', 'ongs.ong_type_id')
            ->where('user_id', $user->id)
            ->get();
        return Inertia::render('Profile/User/OngsRelations', [
            "ong_relations" => $relations->isEmpty() ? null : $relations,
            "date_example" => Membro::date_formater("2025-02-08"),
        ]);
    }
    public function destroy(Membro $membro) {
        $this->authorize("delete", $membro);
        $membro->delete();
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
