<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post_like extends Model {
    protected $fillable = [
        'user_id',
        'post_id',
    ];
}
