<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campanha extends Model {
    use SoftDeletes;
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
