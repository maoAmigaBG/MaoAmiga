<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membro extends Model {
    protected $fillable = [
        'nivel',
        'anonimo',
        'user_id',
        'ong_id',
    ];
    static function ranking($ong_id = null) {
        if (empty($ong_id)) {
            return Membro::select('membros.user_id')->selectRaw('SUM(membros_doacoes.doacao) as donate_amount')->join('membros_doacoes', 'membros_doacoes.membro_id', '=', 'membros.id')->groupBy('membros.user_id')->orderByDesc('donate_amount')->limit(10)->get();
        }
        return Membro::select([ 'membros.id', 'membros.nivel', 'membros.anonimo', 'membros.user_id', 'membros.ong_id', ])->selectRaw("SUM(doacao) as donate_amount")->join("membros_doacoes", "membros_doacoes.membro_id", "=", "membros.id")->where("membros.ong_id", $ong_id)->groupBy('membros.id', 'membros.nivel', 'membros.anonimo', 'membros.user_id', 'membros.ong_id')->orderByDesc("donate_amount")->limit(10)->get();
    }
}
