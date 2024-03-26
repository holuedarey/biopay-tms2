@extends('layouts.simple.master')

@section('title', 'Terminals')

@section('breadcrumb-title')
    <h3>Terminals for Group: {{ $terminalGroup->name }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('terminal-groups.index') }}">Terminal Groups</a></li>
    <li class="breadcrumb-item active">{{ $terminalGroup->name }} Terminals</li>
@endsection

@section('content')
    <x-terminals.body :terminals="$terminalGroup->terminals" />
@endsection
