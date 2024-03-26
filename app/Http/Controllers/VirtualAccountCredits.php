<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VirtualAccountCredits extends Controller
{
    public function index()
    {
        return view('virtual-account-funding.index');
    }
}
