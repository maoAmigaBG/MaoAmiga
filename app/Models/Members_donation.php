<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Members_donation extends Model {
    protected $fillable = [
        'doacao',
        'membro_id',
        'campanha_id',
    ];
    public function membro(): BelongsTo {
        return $this->belongsTo(Member::class);
    }
}
