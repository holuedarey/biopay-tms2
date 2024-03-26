<?php

namespace App\Policies;

use App\Models\Terminal;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TerminalPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('read terminals');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Terminal $terminal): bool
    {
        return $user->is($terminal->agent) || $user->can('update', $terminal);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create terminals');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Terminal $terminal): bool
    {
        if ($user->isSuperAgent())
            return $user->can('edit terminals') && $user->is($terminal->agent->superAgent);

        return $user->is($terminal->agent) || $user->can('edit terminals');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Terminal $terminal): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Terminal $terminal): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Terminal $terminal): bool
    {
        //
    }
}
