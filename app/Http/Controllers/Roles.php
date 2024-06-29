<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\User;
use Psy\Readline\Hoa\Console;
use Spatie\Permission\Models\Permission;
use App\Models\Role;

class Roles extends Controller
{
    public function index()
    {
        \Auth::user()->can('read admin');

        $roles = Role::orderBy('name')
            ->with(['users'])
            ->withCount(['users', 'permissions'])
            ->get();

        return view('pages.roles.index', compact('roles'));
    }

    public function show(Role $role)
    {
        \Auth::user()->can('read admin');

        $permissions = Permission::all()->sortBy('name')->pluck('name')->toArray();

        return view('pages.roles.show', compact('role', 'permissions'));
    }

    public function create()
    {
        \Auth::user()->can('read admin');

        $permissions = Permission::all();
        $types = User::GROUPS;

        return view('pages.roles.create', compact('permissions', 'types'));
    }

    public function store(RoleRequest $request)
    {
        \Auth::user()->can('read admin');

        $data = $request->only('name', 'type');
        $role = Role::create($data);

        $role->givePermissionTo($request->permissions);

        return to_route('roles.index')->with('success', 'New role added!');
    }

    public function update(RoleRequest $request, Role $role)
    {
        \Auth::user()->can('read admin');


        if (!in_array($role->type, [Role::SUPERAGENT, Role::AGENT]))
            $role->update(['name' => $request->name]);

//            Don't change agent's permissions
        if ($role != Role::AGENT) {
            $role->syncPermissions($request->permissions);
        }

        return  back()->with('success', 'Role edited!');
    }



}
