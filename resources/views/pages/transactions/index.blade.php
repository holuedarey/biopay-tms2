@extends('layouts.simple.master')

@section('title', 'Terminals')

@section('breadcrumb-title')
    <h3>Wallet Transactions</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Wallet Transactions</li>
@endsection

@section('content')
    <div class="container-fluid">
        <livewire:transactions-table />
    </div>
@endsection
