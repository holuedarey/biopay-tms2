<?php

namespace App\Http\Controllers;


use App\Models\Fee;
use App\Models\Terminal;
use App\Models\TerminalGroup;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use function back;
use function to_route;
use function view;

class TerminalGroups extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TerminalGroup::class);
    }

    public function index()
    {
        $terminal_groups = TerminalGroup::withCount('terminals')->get();

        return view('pages.terminal-groups.index', compact('terminal_groups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:terminal_groups']
        ]);

        TerminalGroup::create(['name'  => $request->name, 'info' => $request->info]);

        return to_route('terminal-groups.index')->with('pending', "Awaiting approval for new Terminal Group '$request->name'!");
    }

    public function update(Request $request, TerminalGroup $terminalGroup)
    {
        $data = $request->validate([
            'name' => Rule::unique('terminal_groups')->ignoreModel($terminalGroup),
            'info' => 'nullable'
        ]);

        $terminalGroup->update($data);

        return back()->with('pending', 'Awaiting approval for update...');
    }

    public function jsonData()
    {
        return response()->json(TerminalGroup::all());
    }
}
