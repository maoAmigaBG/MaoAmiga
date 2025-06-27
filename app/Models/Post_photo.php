<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Post_photo extends Model {
    protected $fillable = [
        'nome',
        'post_id',
    ];

    public function post() {
        return $this->belongsTo(Post::class);
    }
}
