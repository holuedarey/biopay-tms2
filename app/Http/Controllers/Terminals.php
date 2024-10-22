<?php

namespace App\Http\Controllers;

use App\Http\Requests\TerminalRequest;
use App\Models\Processor;
use App\Models\Terminal;
use App\Models\User;
use Illuminate\Support\Str;

class Terminals extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Terminal::class);
    }

    public function index()
    {
        $terminals = Terminal::with('agent')->get();
        //dd($terminals);
        return view('pages.terminals.index', compact('terminals'));
    }

    public function store(TerminalRequest $request)
    {
        $user = User::whereEmail($request->email)->first();

        Terminal::create([
            'user_id'   => $user->id,
            'device'    => $request->device,
            'tid'       => Terminal::generateTid($user->phone),
            'mid'       => str_pad('2023', 14, '0', STR_PAD_RIGHT),
            'serial'    => $request->serial,
            'group_id'  => $request->group_id,
        ]);

        return back()->with('pending', "New $user->email Terminal - $request->tid awaiting approval! ");
    }

    public function update(TerminalRequest $request, Terminal $terminal)
    {
        $terminal->update($request->validated());

        return back()->with('pending', 'Terminal update awaiting approval.');
    }
}
