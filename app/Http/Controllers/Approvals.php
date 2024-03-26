<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\Fee;
use App\Models\GeneralLedger;
use App\Models\Terminal;
use App\Models\Wallet;
use Cjmellor\Approval\Enums\ApprovalStatus;
use Illuminate\Http\Request;

class Approvals extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Approval::class);
    }

    public function index()
    {
        $approvals = Approval::pending()->latest()->get();

        return view('pages.approvals.index', compact('approvals'));
    }

    public function update(Approval $approval)
    {
        if ($approval->approvalable instanceof Wallet) {
            $approval->updateForWallet();
        }
        elseif ($approval->approvalable instanceof GeneralLedger) {
            $approval->updateForGL();
        }
        else {
            $modelClass = $approval->approvalable_type;

            $modelId = $approval->approvalable_id;

            $model = new $modelClass();

            if ($modelId) {
                $model = $model->find($modelId);
            }

            $data = ($approval->approvalable instanceof Fee) ?
                $approval->dataForFee() : $approval->new_data->toArray();

            $model->fill($data);

            $model->withoutApproval()->save();
        }

        $approval->update(['state' => ApprovalStatus::Approved]);

        return back()->with('success', "Approval successful! $approval->resource $approval->action.");
    }

    public function destroy(Approval $approval)
    {
        $approval->reject();

        return back()->with('success', "Approval rejected! $approval->resource NOT $approval->action.");
    }
}
