<?php

namespace App\Http\Controllers\Api;

use App\Helpers\MyResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\AppUpdates;
use Illuminate\Validation\Rule;

class AppUpdate
{

    public function check(Request $request)
    {
        $request->validate([
            'version' => ['required', 'regex:/^\d\.\d\.\d$/'],
            'device' => [
                'required',
                Rule::in(['HORIZONPAY_K11', 'MOBILE', 'ASINO_A75'])
            ],
        ]);

        $current_version = (int) str_replace('.','', $request->version);

        $latest_update = AppUpdates::where('device', $request->device)->latest()->firstOrFail();

        if ($latest_update->version_code > $current_version) {

            $data = [
                'version' => $latest_update->version,
                'link'    => url(Storage::url('app-update/'. $latest_update->path)),
            ];

            return MyResponse::success($data, "New version {$data['version']} available!");

        } else {
            return MyResponse::failed('Your App is currently up to date!');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'new_version' => ['required', 'regex:/^\d\.\d\.\d$/'],
            'version'     => ['required', 'regex:/^\d\.\d\.\d$/'],
            'device'      => 'required|in:HORIZONPAY_K11,MOBILE,ASINO_A75',
        ]);

        try {
            Log::info(json_encode($request->all()));
            $app = \App\Models\AppUpdates::where('device', $request->device)
                ->where('version', $request->new_version)->first();

            $app->download_count += 1;
            $app->updated_at = now();
            $app->save();

            return MyResponse::success([], "Download success!");

        }
        catch (\Exception $e) {

            Log::info('Increase download count for app update:::' , [$e]);
            return MyResponse::failed('An error occurred. Try again!');
        }


    }
}
