<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model {
    use SoftDeletes;
    protected $fillable = [
        'nome',
        'tipo',
        'descricao',
        'materiais',
        'meta',
        'foto',
        'ong_id',
    ];

    protected $casts = [
        'materiais' => 'array',
    ];

    public function ong(): BelongsTo {
        return $this->belongsTo(Ong::class);
    }
    public function members_donations(): HasMany {
        return $this->hasMany(Members_donation::class);
    }
}
