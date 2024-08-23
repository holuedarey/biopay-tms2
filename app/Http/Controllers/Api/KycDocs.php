<?php

namespace App\Http\Controllers\Api;

use App\Helpers\FileHelper;
use App\Helpers\MyResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\KycRequest;
use App\Models\Kyc;
use App\Models\KycDoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KycDocs extends Controller
{
    public function store(KycRequest $request)
    {
        return MyResponse::success('Document uploaded. Awaiting verification...');
    }

    public function destroy(KycDoc $kycDoc)
    {
        abort_if($kycDoc->isVerified(), 403, 'Unauthorized');

        FileHelper::deleteUploadedFile($kycDoc->path);

        $kycDoc->delete();
    }

    public function fetchImage($user_id)
    {
        // Retrieve all KYC documents for the given user ID
        $kycDocs = Kyc::where('user_id', $user_id)->get();

        if ($kycDocs->isEmpty()) {
            return MyResponse::failed('Documents not found', null, 404);
        }

        $files = [];

        foreach ($kycDocs as $kycDoc) {
            // Get the path to the image, assuming it's relative to storage/app/public
            $path = $kycDoc->file;

            // Check if the file exists on the public disk
            if (Storage::disk('public')->exists($path)) {
                // Get the file contents
                $fileContents = Storage::disk('public')->get($path);

                // Encode the file in Base64
                $base64File = base64_encode($fileContents);

                // Add the encoded file to the array along with the file name
                $files[] = [
                    'file' => $base64File,
                    'file_name' => $kycDoc->name,
                ];
            } else {
                // Optionally, log or handle the case where the file does not exist
                // For example: \Log::warning("File not found: $path");
            }
        }

        if (empty($files)) {
            return MyResponse::failed('No valid files found', null, 404);
        }

        // Return the Base64 encoded files
        return MyResponse::success('KYC documents fetched successfully', $files);
    }




}
