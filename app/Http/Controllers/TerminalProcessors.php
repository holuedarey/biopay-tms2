<?php

namespace App\Http\Controllers;

use App\Models\Processor;
use App\Models\TerminalProcessor;
use Illuminate\Http\Request;

class TerminalProcessors extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TerminalProcessor::class);
    }

    public function index()
    {
        $terminalProcessors = TerminalProcessor::with('owner', 'processor')->get();

        $processors = Processor::all();

        return view('pages.terminal-processors.index', compact('processors', 'terminalProcessors'));
    }

    public function update(Request $request, TerminalProcessor $terminalProcessor)
    {
        $data = $request->validate([
            'serial' => 'string',
            'tid' => 'string',
            'mid' => 'string',
            'category_code' => 'string|size:4',
            'name_location' => 'string|size:40'
        ]);

        $terminalProcessor->update($data);

        return back()->with('pending', 'Terminal processor update awaiting approval.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'serial' => 'string',
            'tid' => 'string',
        ]);

        $processor = Processor::where('id', $request->processor_id)->first();

        $data = [
            'user_id' => auth()->id(),
            'serial' => $request->serial,
            'tid' => $request->tid,
            'mid' => '000000000000000',
            'processor_id' => $processor->id,
            'processor_name' => $processor->name
        ];

        TerminalProcessor::create($data);

        return back()->with('pending', 'Terminal processor creation awaiting approval.');
    }
}
