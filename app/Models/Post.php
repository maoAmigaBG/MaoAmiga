<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model {
    protected $fillable = [
        'nome',
        'descricao',
        'foto',
        'ong_id',
    ];
    public function ong() {
        return $this->belongsTo(Ong::class);
    }
    public function likes(): HasMany {
        return $this->hasMany(Post_like::class);
    }
    static public function getWithLikes() {
        $user_id = Auth::check() ? Auth::user()->id : 0;
        return $posts = self::withExists(['likes as liked' => function ($query) use ($user_id) {$query->where('user_id', $user_id);}])->orderBy("created_at", "asc")->with('ong')->limit(20)->get();
    }
}
