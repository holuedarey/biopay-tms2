<?php

namespace App\Http\Controllers;

use App\Models\AppUpdates;
use Illuminate\Http\Request;

class AppUpdatesController extends Controller
{

    public function index()
    {

        $app_updates = AppUpdates::paginate(25);

        return view('pages.app-updates.index', compact('app_updates'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        try {

            $request->validate([
                'version' => 'required|regex:/^\d\.\d\.\d$/',
                'device' => 'required|string',
                'info' => 'required|string',
                'file' => 'required|file'
            ]);

            $data = $request->only(['version', 'device', 'info']);

            $data['version_code'] = (int) str_replace('.', '', $data['version']);

            $filename = 'irpay_app_' . time() . '.apk';

            $data['path'] = $filename;

            //Store Apk File
            $request->file('file')->storeAs('public/app-update', $filename);


            //Store to database
            AppUpdates::create($data);

            return back()->with('success', 'App Update, version ' .  $data['version'] . 'Uploaded Successful!');
        } catch (\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }
}
