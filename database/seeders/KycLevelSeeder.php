<?php

namespace Database\Seeders;

use App\Helpers\General;
use App\Models\KycLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class KycLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KycLevel::create([
            'name'          => 'SILVER',
            'daily_limit'   => '100000',
            'single_trans_max' => '30000',
            'max_balance'   => '200000'
        ]);

        KycLevel::create([
            'name'          => 'GOLD',
            'daily_limit'   => '200000',
            'single_trans_max' => '50000',
            'max_balance'   => '500000'
        ])->documents()->attach(1);

        KycLevel::create([
            'name'          => 'DIAMOND',
            'daily_limit'   => '500000',
            'single_trans_max' => '70000',
            'max_balance'   => '750000'
        ])->documents()->attach(2);

        KycLevel::create([
            'name'          => 'MERCHANT',
            'daily_limit'   => '1000000',
            'single_trans_max' => '100000',
            'max_balance'   => '1200000'
        ])->documents()->attach([3, 4]);
    }
}
