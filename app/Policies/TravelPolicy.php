<?php

namespace App\Policies;

use App\User;
use App\Models\Travel;
use Illuminate\Auth\Access\HandlesAuthorization;

class TravelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the travel.
     *
     * @param  \App\User $user
     * @param  \App\Models\Travel $travel
     * @return mixed
     */
    public function view(User $user, Travel $travel)
    {
        return $user->id === $travel->user_id;
    }

    /**
     * Determine whether the user can create travels.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the travel.
     *
     * @param  \App\User $user
     * @param  \App\Models\Travel $travel
     * @return mixed
     */
    public function update(User $user, Travel $travel)
    {
        return $user->id === $travel->user_id;
    }

    /**
     * Determine whether the user can delete the travel.
     *
     * @param  \App\User $user
     * @param  \App\Models\Travel $travel
     * @return mixed
     */
    public function delete(User $user, Travel $travel)
    {
        return $user->id === $travel->user_id;
    }
}
