<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Membro;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class MembroPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Membro $membro): bool {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Membro $membro): bool {
        return $user->id == $membro->user_id;
    }
    public function admin(User $user, Membro $membro): bool {
        $admin_member = Membro::where("ong_id", $membro->ong_id)->where("user_id", $user->id)->first();
        return !empty($admin_member) && $admin_member->admin;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Membro $membro): bool {
        return $user->id == $membro->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Membro $membro): bool {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Membro $membro): bool {
        return true;
    }
}
