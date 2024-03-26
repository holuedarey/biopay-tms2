@extends('layouts.simple.master')

@section('title', 'Ledger')

@section('breadcrumb-title')
    <h3>General Ledger</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">General Ledger</li>
@endsection

@section('content')
    <div class="container-fluid" >
        <section class="mt-6">
            <div class="d-flex justify-content-end m-0 p-0"> <i data-lucide="chevrons-right" class="w-4 h-4 inline"></i></div>
            <div class="d-flex overflow-x-scroll mt-1 pb-10 hide-scroll-bar">
                <div class="d-flex flex-nowrap">
                    @foreach($gls as $gl)
                        @php($route = route('general-ledger.show', ['service' => $gl->service->slug]))
                        <div class="zoomIn d-inline-block px-2">
                            <div class="card">
                                <div class="card-body flex justify-between gap-3">
                                    <a class="w-full p-5" href="{{ $route }}">
                                        <div class="text-dark text-opacity-70 text-xs flex font-medium items-center leading-3">
                                            <span class="pe-2 truncate">{{ $gl->service->name }}</span>
                                            <i data-feather="alert-circle" class="w-25"></i>
                                        </div>
                                        <div class="text-dark relative text-xl font-medium leading-5 ps-4 mt-3.5">
                                            @money($gl->balance)
                                        </div>
                                    </a>

                                    @can('edit general ledger')
                                        <div class="p-5">
                                        <span class="flex items-center justify-center w-fit h-fit rounded-full p-3 bg-info bg-opacity-20 hover:bg-opacity-30 text-info cursor-pointer"
                                              data-tw-toggle="modal" data-tw-target="#modal{{$gl->id}}"
                                        >
                                            <i class="fa fa-plus"></i>
                                        </span>
                                        </div>
                                    @endcan
                                </div>
                            </div>
                        </div>

                        @can('edit general ledger')
{{--                            <x-gl-modal :gl="$gl" />--}}
                        @endcan
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
