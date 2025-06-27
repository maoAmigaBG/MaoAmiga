<?php

namespace App\Policies;

use App\Models\Ong;
use App\Models\User;
use App\Models\Membro;
use App\Models\Admin_pedido;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class Admin_pedidoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Ong $ong): bool
    {
        $member = Membro::where("ong_id", $ong->id)->where("user_id", Auth::user()->id)->where("admin", true)->first();
        return !empty($member);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Ong $ong): bool {
        $member = Membro::where("ong_id", $ong->id)->where("user_id", Auth::user()->id)->first();
        return !empty($member);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Admin_pedido $adminPedido): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Admin_pedido $adminPedido): bool {
        $member = Membro::where("ong_id", $adminPedido["ong_id"])->where("user_id", Auth::user()->id)->where("admin", true)->first();
        return !empty($member);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Admin_pedido $adminPedido): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Admin_pedido $adminPedido): bool
    {
        return false;
    }
}
