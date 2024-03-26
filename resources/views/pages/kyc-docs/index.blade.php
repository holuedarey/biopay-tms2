@extends('layouts.simple.master')

@section('title', 'KYC Documents')

@section('breadcrumb-title')
    <h3>KYC Documents</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">KYC Documents</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex flex-md-row flex-column-reverse gap-2 align-items-md-center">
                        <p class="mb-0 me-auto">Showing list of all users kyc documents.</p>
                    </div>

                    <div class="card-body">
                        <div class="list-product">
                            <table class="table" id="project-status">
                                <thead>
                                <tr>
                                    <th scope="col"><span class="f-light f-w-600">Agent's Name</span></th>

                                    <th scope="col"><span class="f-light f-w-600">Doc Type</span></th>

                                    <th scope="col"><span class="f-light f-w-600">Doc Name</span></th>

                                    <th scope="col"><span class="f-light f-w-600">Document</span></th>

                                    <th scope="col"><span class="f-light f-w-600">Verified</span></th>

                                    <th scope="col"><span class="f-light f-w-600">Date Created</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($kyc_docs as $doc)
                                    <tr class="product-removes">
                                        <td>
                                            <x-users.row-data :user="$doc->agent" />
                                        </td>
                                        <td>
                                            <p class="f-light">{{ $doc->type->name }}</p>
                                        </td>
                                        <td>
                                            <p class="f-light">{{ $doc->name }}</p>
                                        </td>
                                        <td>
                                            <a href="{{ $doc->file }}" target="_blank">
                                                <i class="fa fa-file-text-o fa-2x txt-info"></i>
                                            </a>
                                        </td>
                                        <td>
                                            @if($doc->isVerified())
                                                <span class="text-success">{{ $doc->verified_at->toDayDateTimeString()}}</span>
                                            @else
                                                @can('edit kyc-level')
                                                    <form action="{{ route('kyc-docs.update', $doc) }}" method="post" class="my-form">
                                                        @method('PUT')
                                                        @csrf

                                                        <button class="btn form-check form-switch text-center">
                                                            <input class="form-check-input" type="checkbox" role="switch"
                                                                   onchange="this.closest('form').submit()">
                                                        </button>
                                                    </form>
                                                @endcan
                                            @endif
                                        </td>
                                        <td>
                                            <p class="f-light" style="width: 180px">{{ $doc->created_at->toDayDateTimeString() }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Individual column searching (text inputs) Ends-->
        </div>
    </div>
@endsection
