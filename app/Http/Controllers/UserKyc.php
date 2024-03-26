<?php

namespace App\Http\Controllers;

use App\Http\Requests\KycRequest;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;

class UserKyc extends Controller
{
    public function index(User $user)
    {
        $user->load('kyc');

        $documents = Document::file()->get();

        return view('pages.agents.kyc-docs.index', compact(['user', 'documents']));
    }

    public function store(KycRequest $request, User $user)
    {
        $user->kyc()->create($request->fulfilled());

        return back()->with('pending', 'New KYC document upload awaiting approval.');
    }
}
