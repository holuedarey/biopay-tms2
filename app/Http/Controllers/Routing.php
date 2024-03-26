<?php

namespace App\Http\Controllers;

use App\Models\AmountConfig;
use App\Models\CardConfig;
use App\Models\Processor;
use App\Models\RoutingType;
use Illuminate\Http\Request;


class Routing extends Controller
{
    public function index(Request $request)
    {
        $request->user()->can('read settings');

        $types = RoutingType::all();

        return view('pages.routing.index', compact('types'));
    }

    public function show(Request $request, RoutingType $routing)
    {
        $request->user()->can('edit settings');

        $processors = Processor::all();
        $type = $routing->name;

        $items = $type == 'AMOUNT' ? AmountConfig::all() : CardConfig::all();

        return view("pages.routing.settings", compact(['items', 'type', 'processors']));
    }

    public function addSetting(Request $request)
    {
        $request->user()->can('create settings');

        $data = request()->all();
//        dd(request()->all());


        return back()->with('pending', "Awaiting approval for new {$data['type']} setting");
    }
}
