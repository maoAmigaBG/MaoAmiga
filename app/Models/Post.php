<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    static public function getWithCommentsLikes($query)
    {
        $user_id = Auth::check() ? Auth::user()->id : 0;

        return $query->with([
            'ong',
            'likes' => function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            },
            'comments' => function ($query) use ($user_id) {
                $query->with([
                    'user:id,name,foto',
                    'likes' => function ($query) use ($user_id) {
                        $query->where('user_id', $user_id);
                    }
                ])->withCount('likes');
            },
        ])
            ->withCount('likes', 'comments')
            ->withExists([
                'likes as liked' => fn($q) => $q->where('user_id', $user_id)
            ])
            ->latest();
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
