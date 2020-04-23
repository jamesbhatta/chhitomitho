<?php

namespace App\Policies;

use App\LedgerEntry;
use App\Store;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LedgerPolicy
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
     * Determine whether the user can view any ledger entries.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasRoles(['admin', 'manager']);
    }

    /**
     * Determine whether the user can view the ledger entry.
     *
     * @param  \App\User  $user
     * @param  \App\LedgerEntry  $ledgerEntry
     * @return mixed
     */
    public function view(User $user, LedgerEntry $ledgerEntry)
    {
    }

    /**
     * Determine whether the user can create ledger entries.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRoles(['admin', 'manager']);
    }

    /**
     * Determine whether the user can update the ledger entry.
     *
     * @param  \App\User  $user
     * @param  \App\LedgerEntry  $ledgerEntry
     * @return mixed
     */
    public function update(User $user, LedgerEntry $ledgerEntry)
    {
        return $user->hasRoles(['admin', 'manager']);
    }

    /**
     * Determine whether the user can delete the ledger entry.
     *
     * @param  \App\User  $user
     * @param  \App\LedgerEntry  $ledgerEntry
     * @return mixed
     */
    public function delete(User $user, LedgerEntry $ledgerEntry)
    {
        return $user->hasRoles(['admin', 'manager']);
    }

    /**
     * Determine whether the user can restore the ledger entry.
     *
     * @param  \App\User  $user
     * @param  \App\LedgerEntry  $ledgerEntry
     * @return mixed
     */
    public function restore(User $user, LedgerEntry $ledgerEntry)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the ledger entry.
     *
     * @param  \App\User  $user
     * @param  \App\LedgerEntry  $ledgerEntry
     * @return mixed
     */
    public function forceDelete(User $user, LedgerEntry $ledgerEntry)
    {
        //
    }
}
