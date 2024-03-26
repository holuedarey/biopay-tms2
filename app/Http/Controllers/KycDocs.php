<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Models\Kyc;
use App\Models\KycDoc;
use Illuminate\Http\Request;

class KycDocs extends Controller
{
    public function index(Request $request)
    {
        $request->user()->canAny(['read kyc-level', 'read customers']);

        $kyc_docs = Kyc::with('agent')->latest()->get();

        return view('pages.kyc-docs.index', compact('kyc_docs'));
    }


    public function update(Request $request, Kyc $kycDoc)
    {
        $request->user()->can('edit kyc-level');

        $kycDoc->update([
            'verified_at' => now(),
            'verified_by' => auth()->id()
        ]);

//        $msg = Kyc::upgradeLevel($kycDoc);

        return back()->with('success', "Document verified for {$kycDoc->agent->name}");
    }

    public function destroy( KycDoc $kycDoc)
    {
        abort_if($kycDoc->isVerified(), 403, 'Unauthorized.');

        FileHelper::deleteUploadedFile($kycDoc->path);

        $kycDoc->delete();

        return back()->with('pending', 'Document deleted!');
    }
}

