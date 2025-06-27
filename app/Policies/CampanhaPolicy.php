<?php

namespace App\Policies;

use App\Models\Ong;
use App\Models\User;
use App\Models\Membro;
use App\Models\Campanha;
use Illuminate\Auth\Access\Response;

class CampanhaPolicy
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
    public function view(User $user, Campanha $campanha): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Ong $ong): bool {
        $member = Membro::where("ong_id", $ong->id)->where("user_id", $user->id)->where("admin", true);
        return !empty($member);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Campanha $campanha): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Campanha $campanha): bool {
        $member = Membro::where("ong_id", $campanha["ong_id"])->where("user_id", $user->id)->where("admin", true);
        return !empty($member);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Campanha $campanha): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Campanha $campanha): bool
    {
        return false;
    }
}
