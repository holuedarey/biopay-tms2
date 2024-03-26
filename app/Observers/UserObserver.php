<?php

namespace App\Observers;

use App\Helpers\General;
use App\Jobs\CreateVirtualAccount;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param User $user
     * @return void
     */
    public function creating(User $user): void
    {
        $user->password ??= $user->getInitialPassword();
        $user->referral_code = General::generateReference('user');
        $user->level_id = 1;
    }

    /**
     * Handle the User "created" event.
     *
     * @param User $user
     * @return void
     */
    public function created(User $user): void
    {
        $user->wallet()->create();

        dispatch(new CreateVirtualAccount($user));

//        (new Vfd)->createVirtualAccount($user);

        dispatch(fn() => $user->sendEmailVerificationNotification());
    }

    /**
     * Handle the User "updating" event.
     *
     * @param User $user
     * @return void
     */
    public function updating(User $user): void
    {
        if ($user->isDirty('password')) {
            $user->password_change_at = now();
        }
    }

    /**
     * Handle the User "updated" event.
     *
     * @param User $user
     * @return void
     */
    public function updated(User $user): void
    {
        if ($user->wasChanged('level_id')) {
            // Todo: Send email notification to agent.
        }
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param User $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }
}
