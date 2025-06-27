<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post_photo;

class Post extends Model {
    protected $fillable = [
        'nome',
        'descricao',
        'ong_id',
    ];
    public function ong()
    {
        return $this->belongsTo(Ong::class);
    }

    public function photos() {
        return $this->hasMany(Post_photo::class);
    }
}
