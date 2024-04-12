<?php

namespace App\Http\Controllers\Api;

use App\Helpers\MyResponse;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class Register extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $data = $request->validate([
            'serial' => 'required|string|unique:terminals',
            'device' => 'required|string',
            'first_name' => 'required|string',
            'other_names' => 'required|string',
            'email' => 'required|email:rfc,dns|unique:users',
            'phone' => 'required|digits:11|unique:users',
            'gender' => 'required|in:MALE,FEMALE',
            'dob' => 'required|date',
            'bvn' => 'required|string|unique:users',
            'referral_code' => 'sometimes|exists:users',
            'state' => 'required|string',
            'address' => 'required|string',
            'password' => 'required|confirmed',
        ]);

        $data['super_agent_id'] = User::whereReferralCode($request->get('referral_code'))->first()?->id || 6;

        $user = User::create(collect($data)->except(['serial', 'device', 'referral_code'])->toArray());

        $user->assignRole(Role::AGENT);

        $user->createDummyTerminal(...$request->only('serial', 'device', 'phone'));

        return MyResponse::success('Registration successful! Proceed to login to your device.');
    }
}
