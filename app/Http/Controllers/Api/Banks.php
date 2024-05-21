<?php

namespace App\Http\Controllers\Api;

use App\Contracts\TransferServiceInterface;
use App\Helpers\MyResponse;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use Opcodes\LogViewer\Logs\Log;

class Banks extends Controller
{
    public function index(TransferServiceInterface $transferService)
    {
        start:
        \Illuminate\Support\Facades\Log::notice($transferService::name());
        $banks = Bank::whereProvider($transferService::name())->orderBy('name')->get();
        \Illuminate\Support\Facades\Log::notice($banks);

        if ($banks->isEmpty()) {
            $res = $transferService->updateBankList();

            if ($res->success) goto start;

            return MyResponse::failed($res->message);
        }

        return MyResponse::success(data: $banks);
    }
}
