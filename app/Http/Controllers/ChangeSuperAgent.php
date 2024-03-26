<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ChangeSuperAgent extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        $superAgentId = User::role(Role::SUPERAGENT)->whereReferralCode($request->get('referral_code'))->value('id');

        if (! $superAgentId) {
            throw ValidationException::withMessages(['super_agent_id' => 'Invalid ' . Role::SUPERAGENT . ' account.']);
        }

        $user->update(['super_agent_id' =>  $superAgentId]);

        return back()->with('success', Role::SUPERAGENT . ' Updated!');
    }
}
