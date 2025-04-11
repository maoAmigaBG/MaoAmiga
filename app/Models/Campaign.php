<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model {
    protected $fillable = [
        "type",
        "name",
        "description",
        "like_num",
        "donate_size",
        "donate_amount",
        "donate_num",
        "photo",
        "ong_id"
    ];
}
