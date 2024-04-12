<?php

namespace Database\Seeders;

use App\Helpers\General;
use App\Http\Controllers\Approvals;
use App\Models\Approval;
use App\Models\Service;
use App\Models\ServiceProvider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $spout_services = ['CABLE TV', 'AIRTIME', 'INTERNET DATA', 'ELECTRICITY', 'BANK TRANSFER'];
        $services = array_merge($spout_services, ['CASHOUT/WITHDRAWAL', 'WALLET TRANSFER', 'FUNDING/INBOUND', 'LOAN', 'MTN','GLO','AIRTEL', '9MOBILE','AEDC','EEDC','EKEDC', 'KEDCO','PHEDC', 'DSTV','GOTV','STARTIME']);

        collect($services)->each(function ($service) use ($services) {
            $airtimeSubService = ['MTN', 'GLO', 'AIRTEL', '9MOBILE',];
            $electricitySubService = ['AEDC', 'EEDC', 'EKEDC', 'KEDCO', 'PHEDC'];
            $cableSubService = ['DSTV', 'GOTV', 'STARTIME'];
            $s = (new Service([
                'name'  => $service,
                'menu_name' => str($service)->before('/')->value(),
                'internal' => in_array($service, ['LOAN', 'WALLET TRANSFER'])
            ]));

            $s->withoutApproval()->save();

            if (in_array($service, [$services])) {
                $p = ServiceProvider::create([
                    'service_id' => $s->id,
                    'name' => 'Spout',
                    'class' => '\App\Repository\Spout'
                ]);

                $s->update(['provider_id' => $p->id]);
            }
        });
    }
}
