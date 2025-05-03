<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TerminalMonitoring;
use App\Helpers\MyResponse;
use App\Models\Terminal;

class TerminalMonitoringController extends Controller
{
    public function storeOrUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'serialNo' => 'required|string|exists:terminals,serial', // Ensure serial exists in terminals
            'appVersion' => 'nullable|string',
            'batteryLevel' => 'nullable|integer',
            'bluetoothAvailable' => 'nullable|boolean',
            'chipReaderAvailable' => 'nullable|boolean',
            'contactlessReaderAvailable' => 'nullable|boolean',
            'deviceIp' => 'nullable|ip',
            'deviceState' => 'nullable|string',
            'fingerPrintReaderAvailable' => 'nullable|boolean',
            'frontCameraAvailable' => 'nullable|boolean',
            'magstripeReaderAvailable' => 'nullable|boolean',
            'networkState' => 'nullable|boolean',
            'networkType' => 'nullable|string',
            'packageId' => 'nullable|string',
            'printerState' => 'nullable|boolean',
            'requestLat' => 'nullable|numeric',
            'requestLong' => 'nullable|numeric',
            'signalStrength' => 'nullable|integer',
            'storageState' => 'nullable|integer',
        ]);


        if (
            isset($validatedData['requestLat'], $validatedData['requestLong']) &&
            $validatedData['requestLat'] == 0.0 &&
            $validatedData['requestLong'] == 0.0
        ) {
            unset($validatedData['requestLat'], $validatedData['requestLong']);
        }

        // Update if exists, else create new record
        $terminalMonitoring = TerminalMonitoring::updateOrCreate(
            ['serial' => $validatedData['serialNo']], // Match based on serial
            $validatedData
        );


        return MyResponse::success("Terminal monitoring data saved successfully", $terminalMonitoring);
    }

    public function healthData(Request $request)
    {
        $user = auth()->user();
        $validatedData = $request->validate([
            'serialNo' => 'required|string|exists:terminals,serial',
            'appVersion' => 'nullable|string',
            'batteryLevel' => 'nullable|integer',
            'bluetoothAvailable' => 'nullable|boolean',
            'chipReaderAvailable' => 'nullable|boolean',
            'contactlessReaderAvailable' => 'nullable|boolean',
            'deviceIp' => 'nullable|ip',
            'deviceState' => 'nullable|string',
            'fingerPrintReaderAvailable' => 'nullable|boolean',
            'frontCameraAvailable' => 'nullable|boolean',
            'magstripeReaderAvailable' => 'nullable|boolean',
            'networkState' => 'nullable|boolean',
            'networkType' => 'nullable|string',
            'packageId' => 'nullable|string',
            'printerState' => 'nullable|boolean',
            'requestLat' => 'nullable|numeric',
            'requestLong' => 'nullable|numeric',
            'signalStrength' => 'nullable|integer',
            'storageState' => 'nullable|integer',
        ]);


        $terminal = Terminal::where('serial', $validatedData['serialNo'])->first();


        // Log::info('Jaiz Bank API Response:', ['response' => $res]);
        // Update if exists, else create new record
        $terminalMonitoring = TerminalMonitoring::updateOrCreate(
            ['serial' => $validatedData['serialNo']],
            $validatedData
        );

        return MyResponse::success("Terminal monitoring data saved successfully", [
            'terminalMonitoring' => $terminalMonitoring,
        ]);
    }
}
