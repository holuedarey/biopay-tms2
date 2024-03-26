<?php

namespace App\Http\Controllers;

use App\Helpers\RoleHelper;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\TerminalGroup;
use App\Models\User;
use App\Models\Wallet;
use App\Notifications\AccountRegistration;

class Users extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    public function create()
    {
        if (request()->routeIs('agents.onboard')) {
            $roles = RoleHelper::getAgentRoles();
            $title = Role::AGENT . '/' . Role::SUPERAGENT . ' Onboarding';
            $super_agents = Role::findByName(Role::SUPERAGENT)->users;
        }
        elseif(request()->routeIs('admins.register')) {
            $roles = RoleHelper::getAdminRoles();
            $title = 'Admin Registration';
            $super_agents = collect();
        }
        else {
            abort(403, 'Invalid Request');
        }

        return view('pages.users.register', compact('roles', 'title', 'super_agents'));
    }

    public function show(User $user)
    {
        if ($user->isAdmin()) return to_route('users.edit', $user);

        $user->load(['terminals', 'wallet']);

        $transactions = (object) [
            'today' => $user->transactions()->filterByDateDesc('today')->sumAndCount(),
            'week' => $user->transactions()->filterByDateDesc('week')->sumAndCount(),
            'month' => $user->transactions()->filterByDateDesc('month')->sumAndCount(),
            'year' => $user->transactions()->filterByDateDesc('year')->sumAndCount(),
        ];

        return view('pages.users.show', compact('user', 'transactions'));
    }

    public function store(RegisterUserRequest $request)
    {
        $data = $request->role == Role::AGENT ? $request->validated() : $request->except('super_agent_id');

        $user = User::create($data); // Observer creates password, level and wallet;

        $user->assignRole($request->role);

        $user->notify(new AccountRegistration);

        return to_route('users.show', $user)->with('success', "$request->role onboarding successful!");
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());

        return back()->with('success', 'Update successful!');
    }
}
