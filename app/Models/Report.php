<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model {
    protected $fillable = [
        "motivo",
        "user_id",
        "ong_id",
    ];
    public function ong(): BelongsTo {
        return $this->belongsTo(Ong::class);
    }
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
