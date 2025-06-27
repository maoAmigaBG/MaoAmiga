<?php

namespace App\Policies;

use App\Models\Membro;
use Illuminate\Auth\Access\Response;
use App\Models\Ong;
use App\Models\User;

class OngPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Ong $ong): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Ong $ong): bool {
        $member = Membro::where("user_id", $user->id)->where("ong_id", $ong->id)->first();
        return !empty($member) && $member->admin;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ong $ong): bool
    {
        $member = Membro::where("user_id", $user->id)->where("ong_id", $ong->id)->first();
        return !empty($member) && $member->admin || $user->admin;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Ong $ong): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Ong $ong): bool
    {
        return true;
    }
}
