<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campanha extends Model {
    protected $fillable = [
        'nome',
        'tipo',
        'descricao',
        'materiais',
        'meta',
        'foto',
        'ong_id',
    ];
}
