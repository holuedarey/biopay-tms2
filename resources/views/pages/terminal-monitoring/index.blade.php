{{-- @extends('../layout/' . config('view.menu-style')) --}}
@extends('layouts.simple.master')
@section('title', 'Terminal Monitoring')

@section('breadcrumb-title')
    <h3>Terminal Monitoring</h3>
@endsection


@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Terminal Monitoring</li>
@endsection
@section('content')

    {{-- <div class="intro-y flex sm:flex-row flex-col sm:items-center justify-between mt-8">
        <h2 class="text-lg font-medium">
            Terminal Monitoring
        </h2>

    </div> --}}



    <section class="sm:my-10 my-5">
         <!-- BEGIN: TERMINAL Table -->
         <livewire:terminal-monitorings />
         <!-- END: TERMINAL Table -->
    </section>
    {{-- <x-terminal-monitoring.view /> --}}
    {{-- <x-terminal-monitoring.details /> --}}
@endsection
