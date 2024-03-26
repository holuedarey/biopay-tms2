<?php

namespace App\Http\Controllers;


use App\Models\Role;
use Illuminate\Http\Request;

class Agent extends Users
{
    public function index(Request $request)
    {
        $request->user()->can('read customers');

        $name = $request->routeIs('agents.index') ? Role::AGENT : Role::SUPERAGENT;

        return view('pages.users.index', compact('name'));
    }
}
