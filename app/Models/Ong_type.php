<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ong_type extends Model {
    protected $fillable = [
        'nome',
    ];
    public function ongs(): HasMany {
        return $this->hasMany(Ong::class);
    }
}
