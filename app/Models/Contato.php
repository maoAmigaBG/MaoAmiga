<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model {
    protected $fillable = [
        'nome',
        'tipo',
        'ong_id',
    ];
}
