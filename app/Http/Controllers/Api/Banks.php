<?php

namespace App\Http\Controllers\Api;

use App\Contracts\TransferServiceInterface;
use App\Helpers\MyResponse;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Support\Facades\Log;

class Banks extends Controller
{
    public function index(TransferServiceInterface $transferService)
    {
        Log::error(json_encode($transferService::name()));

        start:
        $banks = Bank::whereProvider($transferService::name())->orderBy('name')->get();

        if ($banks->isEmpty()) {
            $res = $transferService->updateBankList();

            if ($res->success) goto start;

            return MyResponse::failed($res->message);
        }

        return MyResponse::success(data: $banks);
    }
}
