<?php

namespace App\Http\Controllers;

use App\Models\Terminal;
use Illuminate\Http\Request;

class TerminalMenus extends Controller
{
    public function index(Terminal $terminal)
    {
        return response()->json([
            'menus' => $terminal->menus,
            'terminal' => $terminal,
            'route' => route('terminals.menus.store', $terminal)
        ]);
    }

    public function store(Request $request, Terminal $terminal)
    {
        $request->validate(['menus.*' => 'required|exists:services,id']);

        $terminal->menus()->sync($request->menus);

        return back()->with('success', "Menus for terminal - $terminal->tid updated!");
    }
}
