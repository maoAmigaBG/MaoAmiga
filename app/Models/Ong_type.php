<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ong_type extends Model {
    protected $fillable = [
        'nome',
    ];

    public function ongs() {
        return $this->hasMany(Ong::class);
    }
}
