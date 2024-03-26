<?php

namespace App\Http\Controllers;

use App\Models\GeneralLedger;
use App\Models\Terminal;
use App\Models\Transaction;
use App\Models\User;
use Spatie\Activitylog\Models\Activity;

class Dashboard extends Controller
{
    public function __invoke()
    {
        $agents = User::viewable()->agent()->with('kycLevel')->limit(5)->get();

        $latest_transactions = Transaction::with(['agent', 'service'])->latest()->limit(5)->get();

//        $terminals = Terminal::countByStatus();

        $gl_balance = GeneralLedger::getBalances();

        $activities = Activity::latest()->whereNotNull('causer_id')->limit(3)->get();

        return view('pages.dashboard', compact(['agents', 'latest_transactions', 'gl_balance', 'activities']));
    }
}
