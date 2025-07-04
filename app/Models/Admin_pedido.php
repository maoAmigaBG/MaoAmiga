<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Admin_pedido extends Model {
    protected $fillable = [
        "ong_id",
        "membro_id",
    ];
}
