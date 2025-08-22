<?php

namespace App\Models;

use Carbon\Carbon;
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
    public function member(): BelongsTo {
        return $this->belongsTo(Member::class);
    }
    public function campaign(): BelongsTo {
        return $this->belongsTo(Campaign::class);
    }
    public function formated_date() {
        return Carbon::createFromDate($this->created_at)->format('d/m/Y H:i');
    }
}
