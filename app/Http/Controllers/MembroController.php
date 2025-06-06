<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Membro;
use Illuminate\Http\Request;

class MembroController extends Controller
{
    public function ongs_relation(User $user) {
        return Membro::select(['ongs.id','ongs.nome', 'ongs.foto', 'membros.updated_at', 'ong_types.nome'])
            ->join('ongs', 'ongs.id', '=', 'membros.ong_id')
            ->join('ong_types', 'ong_types.id', '=', 'ongs.ong_type_id')
            ->join('users', 'users.id', '=', 'membros.user_id')
            ->where('users.id', $user->id)
            ->get();
    }    
}
