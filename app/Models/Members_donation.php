<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Members_donation extends Model {
    protected $fillable = [
        "stripe_payment_intent_id",
        "doacao",
        "moeda",
        "status",
        "member_id",
        "campaign_id",
    ];
    public function membro(): BelongsTo {
        return $this->belongsTo(Member::class);
    }
}
