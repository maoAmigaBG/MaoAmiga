<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    protected $fillable = [
        "name",
        "description",
        "photo",
        "ong_id"
    ];
}
