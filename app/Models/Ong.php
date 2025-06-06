<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ong extends Model {
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
}
