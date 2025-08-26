<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
        'comment_content'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function post(): BelongsTo {
        return $this->belongsTo(Post::class);
    }

    public function likes(): HasMany {
        return $this->hasMany(Comment_like::class);
    }

    public function isLikedBy(User $user): bool {
        return $this->likes()->where('user_id', $user->id)->exists();
    }
}
