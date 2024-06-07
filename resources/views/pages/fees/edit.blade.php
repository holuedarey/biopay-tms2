@extends('layouts.simple.master')

@section('title', 'Edit Fee')

@section('breadcrumb-title')
    <h3>Edit {{ $fee->type }} for {{ $fee->title }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('terminal-groups.fees.index', $group) }}">Fees</a></li>
    <li class="breadcrumb-item active">Edit Fee</li>
@endsection

@section('content')
    <div class="container-fluid" x-data="edit_fee">
        <div class="row gap-6 mt-3">
            <div class="col-12 col-xl-7 col-lg-9 col-md-8">
                <form action="{{ route('fees.update', $fee) }}" class="my-form" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header pb-2">
                            <p class="mb-0">Group Name: <b>{{ $group->name }}</b></p>
                            <p class="mb-0 py-1"><strong>{{ $fee->type }}</strong> for {{ $fee->title }}</p>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row align-items-center">
                                <label class="col-sm-3" for="amount">Amount</label>
                                <div class="col-sm-9">
                                    <input id="amount" type="text" class="form-control" name="amount" value="{{ old('amount', $fee->amount)}}">
                                    <x-input-error input-name="amount" />
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-sm-3" for="amount_type">Amount Type</label>
                                <div class="col-sm-9">
                                    <select id="amount_type" class="form-control" name="amount_type">
                                        @unless($com = $fee->isCommission())
                                            <option value="CONFIG" @selected($fee->amount_type == 'CONFIG')>CONFIG</option>
                                        @endunless
                                        <option value="FIXED" @selected($fee->amount_type == 'FIXED')>FIXED</option>
                                        <option value="PERCENTAGE" @selected($fee->amount_type == 'PERCENTAGE')>PERCENTAGE</option>
                                    </select>

                                    <x-input-error input-name="amount_type" />
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label for="cap" class="col-sm-3">Capped At</label>
                                <div class="col-sm-9">
                                    <input id="cap" type="text" class="form-control" name="cap" value="{{ old('cap') ?? $fee->cap }}">
                                    <x-input-error input-name="cap" />
                                </div>
                            </div>

                            <hr class="mt-4">

                            {{$com }}
                            @if($com && $fee->service->isBillPayment())
                                <div>
                                    <div class="d-flex align-items-center mb-2">
                                        Sharing Structure
                                    </div>

                                    {{--<x-note>
                                        <div>When the amount type is set to <span class="fw-medium">FIXED</span>, the sharing sum must be equal to the main commission Amount above.
                                        If the amount type is set to <span class="fw-medium">PERCENTAGE</span>, the sharing sum must be equal to 100%.</div>
                                    </x-note>--}}

                                    <x-input-error class="mb-2" input-name="structure" />

                                    <div class="mb-3 row align-items-center">
                                        <label class="col-sm-3" for="structure[for_agent]">For {{ \App\Models\Role::AGENT }}</label>
                                        <div class="col-sm-9">
                                            <input id="structure[for_agent]" type="text" class="form-control" name="structure[for_agent]" value="{{ old('structure.for_agent', $fee->agent_commission)}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row align-items-center">
                                        <label class="col-sm-3" for="structure[for_super_agent]">For {{ \App\Models\Role::SUPERAGENT }}</label>
                                        <div class="col-sm-9">
                                            <input id="structure[for_super_agent]" type="text" class="form-control" name="structure[for_super_agent]" value="{{ old('structure.for_super_agent', $fee->super_agent_commission)}}">
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div>

                                    <div class="d-flex align-items-center mb-2">
                                        Bands Configurations
                                        <button type="button" @click="configs.push({'range': '', 'amount': 0})"
                                                class="btn btn-sm btn-primary w-fit ms-auto px-2 py-0">+ Add</button>
                                    </div>
                                    <x-note>To enable configuration, set&nbsp;<span class="fw-medium">Amount Type</span>&nbsp;above to&nbsp;<strong>CONFIG</strong></x-note>

                                    <div class="row mt-2 small fw-medium">
                                        <div class="col-4 pl-2">Amount Range</div>
                                        <div class="col-2"></div>
                                        <div class="col-4 pl-2">Charge</div>
                                        <div class="col-2"></div>
                                    </div>

                                    <div>
                                        <template x-if="configs.length === 0">
                                            <div><input type="hidden" name="config"></div>
                                        </template>

                                        <template x-for="(config, i) in configs">
                                            <div class="row mt-3">
                                                <div class="col-4">
                                                    <input type="text" class="form-control"
                                                           :name="`config[${i}][range]`"
                                                           x-model="config.range"
                                                           value="config"
                                                           placeholder="MIN-MAX"
                                                    >
                                                </div>
                                                <div class="col-2 d-flex justify-content-center align-items-center">
                                                    <x-icons.arrow-right class="w-5 h-5" />
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" class="form-control"
                                                           :name="`config[${i}][amount]`"
                                                           x-model="config.amount"
                                                    >
                                                </div>

                                                <button type="button" @click="deleteConfig(i)"
                                                        class="col-2 btn w-fit text-danger m-2 bg-light-danger px-2 py-1 rounded">x</button>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary btn-hover-effect w-24">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
{{--@if(!$com)--}}
{{--    @push('script')--}}
{{--        --}}
{{--    @endpush--}}
{{--@endif--}}
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('edit_fee', () => ({
            configs: @js(is_string($fee->config) ? json_decode($fee->config) : $fee->config ?? []),

            addConfig() {
                this.configs.push({'range': '', 'amount': 0});
            },

            deleteConfig(index) {
                this.configs.splice(index, 1)
            }
        }))
    })
</script>
