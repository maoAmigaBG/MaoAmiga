<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Admin_request extends Model {
    protected $fillable = [
        "ong_id",
        "membro_id",
    ];
    public function ong(): BelongsTo {
        return $this->belongsTo(Ong::class);
    }
    public function membro(): BelongsTo {
        return $this->belongsTo(Member::class);
    }
}
