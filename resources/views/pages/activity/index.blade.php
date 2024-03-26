@extends('layouts.simple.master')

@section('title', 'Terminals')

@section('breadcrumb-title')
    <h3>Activities</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Activities</li>
@endsection

@section('content')
    <div>
        <livewire:activity-log />
    </div>

@endsection

