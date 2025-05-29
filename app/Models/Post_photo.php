<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post_photo extends Model {
    protected $fillable = [
        'nome',
        'post_id',
    ];
}
