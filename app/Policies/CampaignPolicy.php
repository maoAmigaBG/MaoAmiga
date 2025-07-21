<?php

namespace App\Policies;

use App\Models\Campaign;
use App\Models\Member;
use App\Models\Ong;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CampaignPolicy
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
    public function view(User $user, Campaign $campaign): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Ong $ong): bool {
        $member = Member::where("ong_id", $ong->id)->where("user_id", $user->id)->where("admin", true);
        return !empty($member);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Campaign $campaign): bool
    {
        $member = Member::where("ong_id", $campaign->ong_id)->where("user_id", $user->id)->where("admin", true);
        return !empty($member);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Campaign $campaign): bool {
        $member = Member::where("ong_id", $campaign["ong_id"])->where("user_id", $user->id)->where("admin", true);
        return !empty($member);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Campaign $campaign): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Campaign $campaign): bool
    {
        return false;
    }
}
