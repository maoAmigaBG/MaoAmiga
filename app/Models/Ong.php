<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Membro;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ong extends Model {
    use SoftDeletes;
    protected $fillable = [
        'nome',
        'subtitulo',
        'descricao',
        'lat',
        'log',
        'endereco',
        'banner',
        'foto',
        'ong_type_id',
    ];
    public function members() {
        return  $this->hasMany(Membro::class);
    }
    public static function date_formater($date) {
        Carbon::setLocale('pt_BR');
        return Carbon::parse($date)->translatedFormat('d \d\e F \d\e Y');
    }
    static public function is_adm($ong) {
        return Membro::where("user_id", Auth::user()->id)->where("ong_id", $ong->id)->where("admin", true)->first();
    }
}
