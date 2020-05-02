<?php

namespace App\Policies;

use App\CourierLedger;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CourierLedgerPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->role === 'manager') {
            return true;
        }
        if ($user->role === 'admin') {
            return true;
        }
    }

    /**
     * Determine whether the user can view any courier ledgers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasRoles(['admin', 'manager']);
    }

    /**
     * Determine whether the user can view the courier ledger.
     *
     * @param  \App\User  $user
     * @param  \App\CourierLedger  $courierLedger
     * @return mixed
     */
    public function view(User $user, CourierLedger $courierLedger)
    {
        //
    }

    /**
     * Determine whether the user can create courier ledgers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRoles(['admin', 'manager']);
    }

    /**
     * Determine whether the user can update the courier ledger.
     *
     * @param  \App\User  $user
     * @param  \App\CourierLedger  $courierLedger
     * @return mixed
     */
    public function update(User $user, CourierLedger $courierLedger)
    {
        //
    }

    /**
     * Determine whether the user can delete the courier ledger.
     *
     * @param  \App\User  $user
     * @param  \App\CourierLedger  $courierLedger
     * @return mixed
     */
    public function delete(User $user, CourierLedger $courierLedger)
    {
        //
    }

    /**
     * Determine whether the user can restore the courier ledger.
     *
     * @param  \App\User  $user
     * @param  \App\CourierLedger  $courierLedger
     * @return mixed
     */
    public function restore(User $user, CourierLedger $courierLedger)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the courier ledger.
     *
     * @param  \App\User  $user
     * @param  \App\CourierLedger  $courierLedger
     * @return mixed
     */
    public function forceDelete(User $user, CourierLedger $courierLedger)
    {
        //
    }
}
