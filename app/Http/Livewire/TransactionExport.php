<?php

namespace App\Http\Livewire;

use App\Models\WalletTransaction;
use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Response;

class TransactionExport extends Component
{
    public $start_date;
    public $end_date;

//    public function export()
//    {
//        // Validate the date inputs
//        $this->validate([
//            'start_date' => 'required|date',
//            'end_date' => 'required|date|after_or_equal:start_date',
//        ]);
//
//        // Fetch transactions based on the date range
//       // $transactions = Transaction::whereBetween('created_at', [$this->start_date, $this->end_date])->get();
//        $transactions = WalletTransaction::whereBetween('created_at', [$this->start_date, $this->end_date])
//            ->latest()
//            ->with(['wallet', 'agent'])
//            ->successful()
//            ->get();
//
//        //dd($transactions);
//        // Create the CSV content
//        $csvData = "Name,Amount,Reference,Date, Info\n"; // Header row
//        foreach ($transactions as $transaction) {
//
//            $csvData .= $transaction->agent->name . ",";
//            $csvData .= $transaction->amount . ",";
//            $csvData .= $transaction->reference . ",";
//            $csvData .= $transaction->created_at->format('Y-m-d H:i:s') ;
//            $csvData .= $transaction->info. "\n";
//        }
//
//        // Generate a CSV file response
//        $filename = "transactions_" . now()->format('YmdHis') . ".csv";
//
//        return response()->streamDownload(function () use ($csvData) {
//            echo $csvData;
//        }, $filename, [
//            'Content-Type' => 'text/csv',
//            'Content-Disposition' => "attachment; filename=\"$filename\"",
//        ]);
//    }

//    public function export()
//    {
//        // If no dates are provided, default to today's transactions
//        $startDate = $this->start_date ?? now()->startOfDay()->toDateString();
//        $endDate = $this->end_date ?? now()->endOfDay()->toDateString();
//
//        // Validate the date inputs
//        $this->validate([
//            'start_date' => 'nullable|date',
//            'end_date' => 'nullable|date|after_or_equal:start_date',
//        ]);
//
//        // Fetch transactions based on the date range
//        $transactions = WalletTransaction::whereBetween('created_at', [$startDate, $endDate])
//            ->latest()
//            ->with(['wallet', 'agent'])
//            ->successful()
//            ->get();
//
//        // Create the CSV content
//        $csvData = "Name,Amount,Reference,Date\n"; // Header row
//        foreach ($transactions as $transaction) {
//            $csvData .= $transaction->agent->name . ",";
//            $csvData .= $transaction->amount . ",";
//            $csvData .= $transaction->reference . ",";
//            $csvData .= $transaction->created_at->format('Y-m-d H:i:s') . "\n";
//        }
//
//        // Generate a CSV file response
//        $filename = "transactions_" . now()->format('YmdHis') . ".csv";
//
//        return response()->streamDownload(function () use ($csvData) {
//            echo $csvData;
//        }, $filename, [
//            'Content-Type' => 'text/csv',
//            'Content-Disposition' => "attachment; filename=\"$filename\"",
//        ]);
//    }
    public function export()
    {
        // If no dates are provided, default to today's transactions
        $startDate = $this->start_date ?: now()->startOfDay()->toDateString();
        $endDate = $this->end_date ?: now()->endOfDay()->toDateString();

        // Add 24 hours to start and end dates
        $startDate = now()->parse($startDate)->addDay()->toDateString();
        $endDate = now()->parse($endDate)->addDay()->toDateString();

        dd($startDate);
        // Validate the date inputs
        $this->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Fetch transactions based on the date range
        $transactions = WalletTransaction::whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->with(['wallet', 'agent'])
            ->successful()
            ->get();

        // Create the CSV content
        $csvData = "Name,Amount,Reference,Date\n"; // Header row
        foreach ($transactions as $transaction) {
            $csvData .= $transaction->agent->name . ",";
            $csvData .= $transaction->amount . ",";
            $csvData .= $transaction->reference . ",";
            $csvData .= $transaction->created_at->format('Y-m-d H:i:s') . "\n";
        }

        // Generate a CSV file response
        $filename = "transactions_" . now()->format('YmdHis') . ".csv";

        return response()->streamDownload(function () use ($csvData) {
            echo $csvData;
        }, $filename, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }

    public function render()
    {
        return view('livewire.transaction-export');
    }
}