<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model {
    protected $fillable = [
        "member_level",
        "anonymous",
        "donate_amount",
        "user_id",
        "ong_id"
    ];
}
