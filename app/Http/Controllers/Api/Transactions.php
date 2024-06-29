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
        $defaultLimit = 100; // Set the default limit
        $start = $request->get('startDate');
        $end = $request->get('endDate');



        $startDate = !empty($start) ? Carbon::parse($start)->setTimezone('Africa/Lagos')->startOfDay() : Carbon::now()->setTimezone('Africa/Lagos')->startOfDay();
        $endDate = !empty($end) ? Carbon::parse($end)->setTimezone('Africa/Lagos')->endOfDay() : Carbon::now()->setTimezone('Africa/Lagos')->endOfDay();

        $transactions = TransactionResource::collection(
            auth()->user()->transactions()
                ->whereBetween('created_at', [$startDate, $endDate])
                ->latest()
                ->paginate($request->get('limit', $defaultLimit)) // Use default limit if 'limit' is not provided in the request
        );


        return MyResponse::success('Transactions fetched.', $transactions);
    }

    public function show(Transaction $transaction) {
        return MyResponse::success('Transaction details', $transaction);
    }
}
