<?php

namespace Database\Seeders;

use App\Contracts\TransferServiceInterface;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(TransferServiceInterface $transferService): void
    {
        $transferService->updateBankList();
    }
}
