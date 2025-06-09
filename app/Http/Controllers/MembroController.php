<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Membro;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MembroController extends Controller
{
    public function ong_relations(User $user) {

        return [
            "ong_relations" => Membro::select(['ongs.id','ongs.nome', "ong_types.nome as type", 'ongs.foto', 'membros.created_at'])
                ->join('ongs', 'ongs.id', '=', 'membros.ong_id')
                ->join('ong_types', 'ong_types.id', '=', 'ongs.ong_type_id')
                ->where('user_id', $user->id)
                ->get(),
            "date_formater" => function ($date) {
                    $date = Carbon::parse($date);
                    return $date->translatedFormat("d \d\e F \d\e Y");
                },
        ];
    }    
}
