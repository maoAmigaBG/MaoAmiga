<?php

namespace App\Policies;

use App\Models\Ong;
use App\Models\User;
use App\Models\Membro;
use App\Models\Contato;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class ContatoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Contato $contato): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Ong $ong): bool {
        $member = Membro::where("ong_id", $ong->id)->where("user_id", Auth::user()->id)->where("admin", true)->first();
        return !empty($member);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Contato $contato): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Contato $contato): bool
    {
        $member = Membro::where("ong_id", $contato["ong_id"])->where("user_id", Auth::user()->id)->where("admin", true)->first();
        return !empty($member);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Contato $contato): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Contato $contato): bool
    {
        return false;
    }
}
