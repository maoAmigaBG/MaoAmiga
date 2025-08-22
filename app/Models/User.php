<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'admin',
        'descricao',
        'data_nasc',
        'foto',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public static function date_formater($date) {
        Carbon::setLocale('pt_BR');
        return Carbon::parse($date)->translatedFormat('d \d\e F \d\e Y');
    }

    //verifica se usuário é admin de qualquer ONG, necessário para praticidade no front
    public function isAdminOfOng() {
        return Member::where('user_id', $this->id)->where('admin', true)->exists();
    }
    public function members(): HasMany {
        return $this->hasMany(Member::class);
    }
    public function likes(): HasMany {
        return $this->hasMany(Post_like::class);
    }
    public function comments(): HasMany {
        return $this->hasMany(Comment::class);
    }

    public function reports(): HasMany {
        return $this->hasMany(Report::class);
    }
}
