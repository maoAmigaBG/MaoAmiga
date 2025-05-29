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
}
