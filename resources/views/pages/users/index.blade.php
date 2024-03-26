@extends('layouts.simple.master')

@section('title', $name)

@section('breadcrumb-title')
    <h3>{{ $name }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">{{ $name }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <livewire:users-list :name="$name" />
    </div>
@endsection
