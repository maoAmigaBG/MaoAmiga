<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Membro extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'admin',
        'anonimo',
        'user_id',
        'ong_id',
    ];

    public static function ranking($ong_id = null)
    {
        if (empty($ong_id)) {
            return Membro::select('membros.user_id', 'users.name', 'users.foto')
                ->selectRaw('SUM(membros_doacoes.doacao) as donate_amount')
                ->join('membros_doacoes', 'membros_doacoes.membro_id', '=', 'membros.id')
                ->join('users', 'membros.user_id', '=', 'users.id')
                ->groupBy('membros.user_id', 'users.name', 'users.foto')
                ->orderByDesc('donate_amount')
                ->limit(10)
                ->get();
        }

        // FIX: Add 'users.name' to select and groupBy
        return Membro::select(['membros.id', 'membros.nivel', 'membros.anonimo', 'membros.user_id', 'membros.ong_id', 'users.name', 'users.foto'])
            ->selectRaw("SUM(doacao) as donate_amount")
            ->join("membros_doacoes", "membros_doacoes.membro_id", "=", "membros.id")
            ->join('users', 'membros.user_id', '=', 'users.id')
            ->where("membros.ong_id", $ong_id)
            ->groupBy('membros.id','membros.nivel','membros.anonimo','membros.user_id','membros.ong_id','users.name', "users.foto")
            ->orderByDesc("donate_amount")
            ->limit(10)
            ->get();
    }

    public static function members_amount($ong_id)
    {
        return Membro::where("ong_id", $ong_id)->get()->count();
    }

    public static function date_formater($date)
    {
        Carbon::setLocale('pt_BR');
        return Carbon::parse($date)->translatedFormat('d \d\e F \d\e Y');
    }
}