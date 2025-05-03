<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class TerminalMonitoring extends Controller
{
    public function index()
    {
        return view('pages.terminal-monitoring.index');
    }
}
