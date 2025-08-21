<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'foto',
        'ong_id',
    ];
    public function ong(): BelongsTo
    {
        return $this->belongsTo(Ong::class);
    }
    public function likes(): HasMany
    {
        return $this->hasMany(Post_like::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    static public function getWithCommentsLikes()
    {
        $user_id = Auth::check() ? Auth::user()->id : 0;
        return self::with([
            'ong',
            'likes' => fn($q) => $q->where('user_id', $user_id),
            'comments.user:id,name,foto'
        ])->withExists([
                    'likes as liked' => fn($q) => $q->where('user_id', $user_id)
                ])->orderBy("created_at", "desc");
    }

    static public function getWithLikes()
    {
        $user_id = Auth::check() ? Auth::user()->id : 0;
        return self::with([
            'ong',
            'likes' => fn($q) => $q->where('user_id', $user_id)
        ])->withExists([
                    'likes as liked' => fn($q) => $q->where('user_id', $user_id)
                ])->orderBy("created_at", "desc");
    }

    public static function getPostsOfAdminOngs()
    {
        $user_id = Auth::check() ? Auth::user()->id : 0;

        return self::whereHas('ong.members', function ($query) use ($user_id) {
            $query->where('user_id', $user_id)
                ->where('admin', true);
        })->with('ong')->latest();
    }
}
