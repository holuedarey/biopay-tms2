<?php

namespace App\Contracts;

use App\Models\User;
use App\Models\VirtualAccount;

interface VirtualAccountInterface
{
    /**
     * Create a virtual account for a user
     *
     * @param User $user
     * @return VirtualAccount With keys of <b>account_no</b> and <b>bank_name</b>.
     */
    public function createVirtualAccount(User $user): VirtualAccount;
}