<?php

namespace App\Http\Controllers;


use App\Http\Requests\FeeUpdateRequest;
use App\Models\Fee;
use App\Models\TerminalGroup;

class Fees extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Fee::class);
    }

    public function index(TerminalGroup $terminalGroup)
    {
        $fees = $terminalGroup->fees->load(['service', 'group']);

        return view('pages.terminal-groups.fees', compact(['terminalGroup', 'fees']));
    }

    public function edit(Fee $fee)
    {
        $group = $fee->group;

        return view('pages.fees.edit', compact('group', 'fee'));
    }


    public function update(FeeUpdateRequest $request, Fee $fee)
    {
        return back()->with('pending', "Awaiting approval for Fee update!");
    }
}
