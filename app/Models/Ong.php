<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ong extends Model {
    protected $fillable = [
        "name",
        "subname",
        "email",
        "phone",
        "adress",
        "description",
        "ong_type_id",
        "photo"
    ];
}
