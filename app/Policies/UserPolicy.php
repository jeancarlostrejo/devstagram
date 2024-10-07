<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $userAuth, User $userProfile): bool
    {
        return $userAuth->id === $userProfile->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $userAuth, User $userProfile): bool
    {
        return $userAuth->id === $userProfile->id;
    }

    public function notOwnUser(User $userAuth, User $userProfile): bool
    {
        return $userAuth->id !== $userProfile->id;
    }

    public function follow(User $authUser, User $userFollow): bool
    {
        return !($userFollow->checkFollow($authUser)) && $this->notOwnUser($authUser, $userFollow);
    }

    public function unfollow(User $authUser, User $userFollow): bool
    {
        return $userFollow->checkFollow($authUser) && $this->notOwnUser($authUser, $userFollow);
    }
}
