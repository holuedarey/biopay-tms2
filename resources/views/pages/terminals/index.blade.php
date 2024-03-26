@extends('layouts.simple.master')

@section('title', 'Terminals')

@section('breadcrumb-title')
    <h3>Terminals</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Terminals</li>
@endsection

@section('content')
    <x-terminals.body :$terminals />
@endsection
