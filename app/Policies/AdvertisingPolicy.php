<?php

namespace App\Policies;

use App\Advertising;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdvertisingPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Advertising $advertising
     * @return bool
     */
    public function modify(User $user, Advertising $advertising)
    {
        return $user->id === $advertising->user_id;
    }
}
