<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcessorRequest;
use App\Models\Processor;
use Illuminate\Http\Request;

class Processors extends Controller
{
    public function index()
    {
        $processors = Processor::all();

        return view('pages.processors.index', compact('processors'));
    }

    public function update(ProcessorRequest $request, Processor $processor)
    {

        $processor->update($request->validated());

        return back()->with('pending', 'Awaiting approval for processor update');
    }

    public function store(ProcessorRequest $request)
    {
        Processor::create($request->validated());

        return back()->with('pending', 'Awaiting approval for processor creation');
    }
}
