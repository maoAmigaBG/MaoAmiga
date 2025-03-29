<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ["title", "body", "user_id"]; // sinalizate what fields needs to be feeded
    public function get_user() {
        return $this->belongsTo(User::class, "user_id");
    }
}
