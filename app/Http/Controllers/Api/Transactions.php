<?php

namespace App\Http\Controllers\Api;

use App\Helpers\MyResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Transactions extends Controller
{
    public function index(Request $request)
    {
        $startDate = !empty($request->get('startDate')) ? Carbon::parse($request->get('startDate'))  : Carbon::now()->format('YY-m-d');
        $endDate = !empty($request->get('endDate')) ? Carbon::parse($request->get('endDate'))  : Carbon::now()->format('YY-m-d');;
        $transactions = TransactionResource::collection(
            auth()->user()->transactions()->whereBetween('created_at', [$startDate, $endDate])->latest()->paginate($request->get('limit'))
        );

        return MyResponse::success('Transactions fetched.', $transactions);
    }

    public function show(Transaction $transaction) {
        return MyResponse::success('Transaction details', $transaction);
    }
}
