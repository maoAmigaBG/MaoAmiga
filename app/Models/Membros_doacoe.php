<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membros_doacoe extends Model {
    protected $fillable = [
        'doacao',
        'membro_id',
        'campanha_id',
    ];
}
