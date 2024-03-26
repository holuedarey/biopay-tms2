<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class Permissions extends Controller
{
    public function index()
    {
        \Auth::user()->can('read admin');

        $permissions = Permission::with('roles')->get();

        return view('pages.permissions.index', compact('permissions'));
    }
}
