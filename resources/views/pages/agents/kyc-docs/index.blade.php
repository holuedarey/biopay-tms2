@extends('layouts.simple.master')

@section('title', "Agent KYC")

@section('breadcrumb-title')
    <h3>Agent's KYC</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('users.show', $user) }}">Agent</a></li>
    <li class="breadcrumb-item active">Agent's KYC</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">
                <div class="col-12 col-md-7 col-lg-12 col-xl-7">
                    <x-note>
                        @php($levels = app('levels'))
                        <div>
                            <p class="pb-1">
                                There are {{ $levels->count() }} levels and to update to a higher level requires certain documents to be uploaded as stated below:
                            </p>
                            <ul>
                                @foreach($levels as $level)
                                    <li>
                                        <span class="fw-medium">{{ $level->name }} - </span>
                                        <span @class(['text-dark', 'text-secondary' => is_null($level->required_doc)])>
                                            {{ $level->required_doc ?? '...' }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </x-note>
                </div>
                <div class="col-12 col-sm-6 col-md-5 col-lg-6 col-xl-5">
                    <div class="card py-2 px-4">
                        <p>{{ $user->first_name }}'s current level - <span class="fw-medium">{{ $user->kycLevel->name }}</span></p>

                        <form action="{{ route('users.manage-level.store', $user) }}" method="post" class="my-form">
                            @csrf
                            <div class="form-inline">
                                <label for="level" class="form-label">Change Level</label>
                                <div class="w-100">
                                    <select name="level_id" id="level" class="form-control form-select">
                                        @foreach(app('levels') as $level)
                                            <option value="{{ $level->id }}" @selected($level->id == $user->level_id)>
                                                {{ $level->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <x-input-error input-name="level_id" />
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-3 pt-2 border-top">
                                <button type="submit" class="btn btn-primary w-24">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-6 col-xl-4">
                    <div class="card p-4">
                        <form method="post" action="{{ route('users.update', $user->id) }}" class="my-form">
                            @csrf
                            @method('PUT')
                            <div class="form-inline">
                                <label for="bvn" class="form-label">BVN</label>
                                <div class="w-100">
                                    <input id="bvn" type="text" class="form-control"
                                           placeholder="Agent's bank verification number"
                                           name="bvn" value="{{old('bvn') ?? $user->bvn }}"
                                    >
                                    <x-input-error input-name="bvn" />
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-3 pt-2 border-top">
                                <button type="submit" class="btn btn-primary w-24">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-8 col-lg-12 col-xl-8">
                    <div class="card">
                        <div class="card-header d-flex flex-md-row flex-column-reverse gap-2 align-items-md-center">
                            <p class="mb-0 me-auto">Showing list of all KYC documents.</p>
                            <button type="button"
                                    class="btn btn-primary btn-hover-effect d-flex justify-content-center align-items-center gap-2 px-3"
                                    data-bs-toggle="modal" data-bs-target="#document-upload"
                            >
                                <i data-feather="plus-square" style="height: 15px"></i>
                                <span>New Upload</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive signal-table">
                                <table class="table table-hover sm:mt-2">
                                    <thead>
                                    <tr>
                                        <th scope="col"><span class="f-light f-w-600">Doc Type</span></th>

                                        <th scope="col"><span class="f-light f-w-600">Doc Name</span></th>

                                        <th scope="col"><span class="f-light f-w-600">Document</span></th>

                                        <th scope="col"><span class="f-light f-w-600">Verified At</span></th>

                                        <th scope="col"><span class="f-light f-w-600">Date Created</span></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($user->kyc as $doc)
                                        <tr>
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
                                                    <p class="f-light" style="width: 180px">{{ $doc->verified_at->toDayDateTimeString() }}</p>
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
            </div>
        </div>
    </div>

    <x-modal-form id="document-upload" action="{{ route('users.kyc.store', $user) }}" enctype="multipart/form-data">
        <x-slot:header>Upload New Document</x-slot:header>
        <div>
            <div class="mt-3">
                <label for="document_id" class="pr-2">Document Type</label>
                <div class="w-full">
                    <select id="document_id" name="document_id" class="form-control form-select" required>
                        <option disabled selected>-- Selected document type --</option>
                        @foreach($documents as $document)
                            <option value="{{ $document->id }}">{{ $document->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error input-name="document_id" />
                </div>
            </div>

            <div class="mt-3">
                <label for="name" class="form-label pr-2">Document Name</label>
                <div class="w-full">
                    <input id="name" type="text" class="form-control"
                           placeholder="Driver's license, voter's card, waste bill, etc."
                           name="name" value="{{old('name')}}"
                           required
                    >
                    <x-input-error input-name="name" />
                </div>
            </div>
            <div class="mt-3">
                <label for="file" class="form-label pr-2">File</label>
                <div class="w-full">
                    <input class="form-control" type="file" id="file" name="file" required
                    />
                </div>
            </div>
        </div>
    </x-modal-form>
@endsection
