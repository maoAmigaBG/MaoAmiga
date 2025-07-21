<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Membro;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ong extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'nome',
        'subtitulo',
        'descricao',
        'lat',
        'log',
        'endereco',
        'banner',
        'foto',
        'ong_type_id',
    ];

    public function type(): BelongsTo {
        return $this->belongsTo(Ong_type::class);
    }
    public function admin_requests(): HasMany {
        return $this->hasMany(Admin_request::class);
    }
    public function campaigns(): HasMany {
        return $this->hasMany(Campaign::class);
    }
    public function contacts(): HasMany {
        return $this->hasMany(Contact::class);
    }
    public function members(): HasMany {
        return $this->hasMany(Member::class);
    }
    public function posts(): HasMany {
        return $this->hasMany(Post::class);
    }
    public function reports(): HasMany {
        return $this->hasMany(Report::class);
    }
    public static function date_formater($date) {
        Carbon::setLocale('pt_BR');
        return Carbon::parse($date)->translatedFormat('d \d\e F \d\e Y');
    }
    static public function is_adm($ong) {
        if (!Auth::check() || !$ong) {
            return false;
        }
        
        $user_id = Auth::user()->id;

        $is_admin = Member::where('user_id', $user_id)
            ->where('ong_id', $ong->id)
            ->where('admin', true)
            ->exists();
        return $is_admin;
    }

}
