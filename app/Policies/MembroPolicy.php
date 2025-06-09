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
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Membro $membro): bool {
        return Auth::check() && Auth::user()->id == $membro->user_id;
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
