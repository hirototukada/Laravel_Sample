<?php

namespace App\Policies;

use App\Spending;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpendingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any spendings.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user, Spending $spending)
    {
        //
    }

    /**
     * Determine whether the user can view the spending.
     *
     * @param  \App\User  $user
     * @param  \App\Spending  $spending
     * @return mixed
     */
    public function view(User $user, Spending $spending)
    {
        return $user->id === $spending->user_id;
    }

    /**
     * Determine whether the user can create spendings.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the spending.
     *
     * @param  \App\User  $user
     * @param  \App\Spending  $spending
     * @return mixed
     */
    public function update(User $user, Spending $spending)
    {
        //
    }

    /**
     * Determine whether the user can delete the spending.
     *
     * @param  \App\User  $user
     * @param  \App\Spending  $spending
     * @return mixed
     */
    public function delete(User $user, Spending $spending)
    {
        //
    }

    /**
     * Determine whether the user can restore the spending.
     *
     * @param  \App\User  $user
     * @param  \App\Spending  $spending
     * @return mixed
     */
    public function restore(User $user, Spending $spending)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the spending.
     *
     * @param  \App\User  $user
     * @param  \App\Spending  $spending
     * @return mixed
     */
    public function forceDelete(User $user, Spending $spending)
    {
        //
    }
}
