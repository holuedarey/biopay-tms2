@extends('layouts.simple.master')

@section('title', 'Wallets')

@section('breadcrumb-title')
    <h3>Wallets</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Wallets</li>
@endsection

@section('content')
    <div class="container-fluid"  x-data="{action: '', acc_no: '', name: ''}">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        Showing list of all wallets.
                    </div>

                    <div class="card-body">
                        <div class="list-product">
                            <table class="table" id="project-status">
                                <thead>
                                <tr>
                                    <th> <span class="f-light f-w-600">Name</span></th>
                                    <th> <span class="f-light f-w-600">Role</span></th>
                                    <th> <span class="f-light f-w-600" style="width: 150px">Account Number</span></th>
                                    <th> <span class="f-light f-w-600">Balance</span></th>
                                    <th> <span class="f-light f-w-600 pe-4">Status</span></th>
                                    <th> <span class="f-light f-w-600">Created</span></th>
                                    <th data-sortable="false">
                                        <span class="f-light f-w-600">
                                            <i class="fa fa-cogs"></i>
                                        </span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($wallets as $wallet)
                                    <tr class="product-removes">
                                        <td>
                                            <x-users.row-data :user="$wallet->agent" />
                                        </td>
                                        <td style="width: 50px">
                                            <span class="badge badge-info">{{ $wallet->agent->role_name }}</span>
                                        </td>
                                        <td>
                                            <p class="f-light">{{ $wallet->account_number }}</p>
                                        </td>
                                        <td>
                                            <p class="f-light">@money($wallet->account_number)</p>
                                        </td>
                                        <td>
                                            <livewire:status-toggle-badge :model="$wallet" />
                                        </td>
                                        <td>
                                            <p class="f-light" style="width: 100px">{{ $wallet->created_at->toDayDateTimeString() }}</p>
                                        </td>

                                        <td>
                                            <div class="product-action">
                                                <button class="btn btn-info btn-sm d-flex align-items-center gap-1 px-2 py-1"
                                                        data-bs-toggle="modal" data-bs-target="#impact-wallet"
                                                        x-on:click="action = '{{ route('wallets.update', $wallet) }}'; name = '{{ $wallet->agent->name }}'; acc_no = @js($wallet->account_number)"
                                                >
                                                    <i class="fa fa-plus-square-o"></i> Credit/Debit
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Individual column searching (text inputs) Ends-->
        </div>

        <div class="modal fade" id="impact-wallet" tabindex="-1" role="dialog" aria-labelledby="impact-wallet" aria-hidden="true">
            <div class="modal-dialog">
                <form :action="action" class="modal-content my-form" method="post">
                    <div class="modal-header fw-medium">
                        Credit/Debit Wallet for <span x-text="name"></span>
                        <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('PUT')

                        <p class="mb-2">Account Number - <span class="font-medium" x-text="acc_no"></span></p>

                        <x-note message="The debit or credit impact on the wallet would require approval."/>

                        <div class="mt-3">
                            <label for="amount" class="form-label">Amount</label>
                            <div class="w-100">
                                <input id="amount" name="amount" type="text" class="form-control" placeholder="0.00" />
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="action" class="form-label">Action</label>
                            <div class="w-100">
                                <select id="action" name="action" class="form-control form-select" required>
                                    <option disabled selected>-- Select action --</option>
                                    <option value="{{ \App\Enums\Action::CREDIT }}">Credit</option>
                                    <option value="{{ \App\Enums\Action::DEBIT }}">Debit</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="info" class="form-label">Reason/Info</label>
                            <div class="w-100">
                                <textarea name="info" id="info" class="form-control" rows="4" required></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- BEGIN: Slide Over Footer -->
                    <div class="modal-footer text-right mt-2">
                        <button class="btn btn-outline-light" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-hover-effect" type="submit">Submit</button>
                    </div>
                    <!-- END: Slide Over Footer -->
                </form>
            </div>
        </div> <!-- END: Slide Over Content -->
    </div>
@endsection
