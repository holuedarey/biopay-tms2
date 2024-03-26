@extends('layouts.simple.master')

@section('title', 'Ledger')

@section('breadcrumb-title')
    <h3>Ledger</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Ledger</li>
@endsection

@section('content')
    <div class="container-fluid" >
        <livewire:ledger-page />
    </div>
@endsection
