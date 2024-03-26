<?php

namespace App\Http\Controllers;


use App\Helpers\RoleHelper;
use App\Models\User;
use Illuminate\Http\Request;

class Admin extends Users
{

    public Object $user;

    public function index(Request $request)
    {
        $request->user()->can('read admin');

        $users = User::role(RoleHelper::getAdminRoles())
            ->with('kycLevel')->get();

        return view('pages.users.admin', compact('users'));
    }


}
