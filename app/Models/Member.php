<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'admin',
        'anonimo',
        'user_id',
        'ong_id',
    ];
    public function ong(): BelongsTo {
        return $this->belongsTo(Ong::class);
    }
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
    public static function ranking($ong_id = null)
    {
        if (empty($ong_id)) {
            return Member::select('members.user_id', 'users.name', 'users.foto')
                ->selectRaw('SUM(members_donations.doacao) as donate_amount')
                ->join('members_donations', 'members_donations.member_id', '=', 'members.id')
                ->join('users', 'members.user_id', '=', 'users.id')
                ->groupBy('members.user_id', 'users.name', 'users.foto')
                ->orderByDesc('donate_amount')
                ->limit(10)
                ->get();
        }

        // FIX: Add 'users.name' to select and groupBy
        return Member::select(['members.id', 'members.nivel', 'members.anonimo', 'members.user_id', 'members.ong_id', 'users.name', 'users.foto'])
            ->selectRaw("SUM(doacao) as donate_amount")
            ->join("members_donations", "members_donations.member_id", "=", "members.id")
            ->join('users', 'members.user_id', '=', 'users.id')
            ->where("members.ong_id", $ong_id)
            ->groupBy('members.id','members.nivel','members.anonimo','members.user_id','members.ong_id','users.name', "users.foto")
            ->orderByDesc("donate_amount")
            ->limit(10)
            ->get();
    }

    public static function members_amount($ong_id)
    {
        return Member::where("ong_id", $ong_id)->get()->count();
    }

    public static function date_formater($date)
    {
        Carbon::setLocale('pt_BR');
        return Carbon::parse($date)->translatedFormat('d \d\e F \d\e Y');
    }
}