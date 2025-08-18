<?php

namespace App\Policies;

use App\Models\Campaign;
use Illuminate\Auth\Access\Response;
use App\Models\Members_donation;
use App\Models\User;

class DonationPolicy
{
    public function viewAny(User $user): bool {
        return true;
    }
    public function view(User $user, Members_donation $membersDonation): bool {
        return true;
    }
    public function create(User $user, Campaign $campaign): bool {
        return true;
    }
    public function update(User $user, Members_donation $membersDonation): bool {
        return true;
    }
    public function delete(User $user, Members_donation $membersDonation): bool {
        return true;
    }
    public function restore(User $user, Members_donation $membersDonation): bool {
        return true;
    }
    public function forceDelete(User $user, Members_donation $membersDonation): bool {
        return true;
    }
}
