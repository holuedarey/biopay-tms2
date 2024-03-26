<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class Loans extends Controller
{
    public function index(Request $request)
    {
        return view('pages.loans.index');
    }

    public function update(Request $request, Loan $loan)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(Status::forLoans())],
            'reason' => 'required_if:status,' . Status::DECLINED->value
        ]);

        $loan->update($data);

        return back()->with('success', 'Loan request ' . $request->get('status'));
    }
}
