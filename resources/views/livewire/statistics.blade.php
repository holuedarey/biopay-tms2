<div class="row h-auto">
    @foreach($services as $service)
        <div class="col-12">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <h4 class="font-medium small">{{ $service->name }}</h4>
            </div>
            <div class="d-flex gap-3 overflow-auto py-1">
                <div class="card widget-1 w-100">
                    <div class="card-body">
                        <div class="widget-content">
                            <div class="widget-round primary">
                                <div class="bg-round">
                                    <img src="{{ $service->icon }}" class="w-50" alt="">
                                    <svg class="half-circle svg-fill">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#halfcircle') }}"></use>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4>{{ $service->total_trans }}</h4>
                                <span class="f-light">Total</span>
                            </div>
                        </div>
                        <x-percentage-badge :value="$service->total_percent" />
                    </div>
                </div>
                <div class="card widget-1 w-100">
                    <div class="card-body">
                        <div class="widget-content">
                            <div class="widget-round success">
                                <div class="bg-round">
                                    <i class="fa fa-thumbs-o-up text-success"></i>
                                    <svg class="half-circle svg-fill">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#halfcircle') }}"></use>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4>{{ $service->successful }}</h4>
                                <span class="f-light">Successful</span>
                            </div>
                        </div>
                        <x-percentage-badge :value="$service->success_percent" />
                    </div>
                </div>
                <div class="card widget-1 w-100">
                    <div class="card-body">
                        <div class="widget-content">
                            <div class="widget-round secondary">
                                <div class="bg-round">
                                    <i class="fa fa-thumbs-o-down text-danger"></i>
                                    <svg class="half-circle svg-fill">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#halfcircle') }}"></use>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4>{{ $service->failed }}</h4>
                                <span class="f-light">Failed</span>
                            </div>
                        </div>
                        <x-percentage-badge :value="$service->failed_percent" />
                    </div>
                </div>
            </div>

            {{-- Response codes for cashout --}}
            {{--@if($service->slug == 'cashoutwithdrawal' && $transactions->isNotEmpty())
                <h5 class="font-medium text-[12px] pt-1">Response Codes</h5>
                <div class="flex lg:block overflow-auto pb-5 pt-1.5 hide-scroll-bar">
                    <div class="flex flex-nowrap gap-5">
                        @foreach($transactions as $transaction)
                            <div class="zoom-in w-52">
                                <div class="box px-5 py-2">
                                    <div class="flex items-center">
                                        <div class="{{ $transaction->response_code == '00' ? 'text-success' : 'text-danger' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="database" data-lucide="database" class="lucide lucide-database w-4 h-4"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg>
                                        </div>
                                        <span class="px-1 text-sm text-slate-500">{{ $transaction->response_code }}</span>
                                    </div>
                                    <p class="font-medium text-xl pt-1">{{ $transaction->count }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif--}}
        </div>
    @endforeach
</div>
