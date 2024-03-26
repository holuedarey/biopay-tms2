<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{


    public function index(Request $request)
    {
        $request->user()->can('read admin');

       return view('pages.activity.index' );
    }
}
