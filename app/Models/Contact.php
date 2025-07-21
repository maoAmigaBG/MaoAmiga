<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model {
    protected $fillable = [
        'nome',
        'tipo',
        'ong_id',
    ];
    public function ong(): BelongsTo {
        return $this->belongsTo(Ong::class);
    }
}
