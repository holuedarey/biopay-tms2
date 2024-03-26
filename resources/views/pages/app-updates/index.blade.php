@extends('layouts.simple.master')

@section('title', 'App Uploads')

@section('breadcrumb-title')
    <h3>App Management</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">App Management</li>
@endsection

@section('content')
    <div class="container-fluid" x-data="{level: {}, action: null}">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex flex-md-row flex-column-reverse gap-2 align-items-md-center">
                        <p class="mb-0 me-auto">Showing list of all App Uploads</p>
                            <button type="button"
                                    class="btn btn-primary btn-hover-effect d-flex justify-content-center align-items-center gap-2 px-3"
                                    data-bs-toggle="modal" data-bs-target="#upload-app"
                            >
                                <i data-feather="plus-square" style="height: 15px"></i>
                                <span>Upload App</span>
                            </button>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <div class="table-responsive signal-table">
                                <table class="table table-hover sm:mt-2">
                                    <thead>
                                        <tr>
                                            <th scope="col"><span class="f-light f-w-600">Version</span></th>
                                            <th scope="col"><span class="f-light f-w-600">Device</span></th>
                                            <th scope="col"><span class="f-light f-w-600">Description</span></th>
                                            <th scope="col"><span class="f-light f-w-600">Downloads</span></th>
                                            <th scope="col"><span class="f-light f-w-600">Uploaded At</span></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if($app_updates->count() == 0)
                                            <tr><td colspan="5" class="text-center">No App Update has been added yet</td></tr>
                                        @else
                                            @foreach($app_updates as $app_update)
                                                <tr>
                                                    <td>{{ $app_update->version }}</td>
                                                    <td>{{ $app_update->device }}</td>
                                                    <td>{{ $app_update->info }}</td>
                                                    <td>{{ $app_update->download_count }}</td>
                                                    <td>{{ $app_update->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div>
        <x-modal-form id="upload-app" action="{{ route('app-updates.create') }}" enctype="multipart/form-data">
            <x-slot:header> Upload App</x-slot:header>

            <div class="mt-3">
                <label for="version" class="form-label sm:w-56">Version</label>
                <div class="w-full">
                    <input id="version" type="text" class="form-control" placeholder="Eg: 1.0.0" name="version" value="{{ old('version') }}">
                    <x-input-error input-name="version" />
                </div>
            </div>

            <div class="mt-3">
                <label for="device" class="form-label w-fit">Device</label>
                <div class="w-100">
                    <select name="device" class="form-select"  required>
                        <option value="" disabled selected></option>
                        <option value="HORIZONPAY_K11">HORIZONPAY K11</option>
                        <option value="MOBILE">MOBILE</option>
                        <option value="ASINO_A75">ASINO A75</option>
                    </select>
                    <x-input-error input-name="device" />
                </div>
            </div>

            <div class="mt-3">
                <label for="daily_limit" class="form-label sm:w-56">Description</label>
                <div class="w-full">
                    <label for="info"></label><textarea class="form-control @error('info') is-invalid @enderror" id="info" name="info" type="text" required value="{{ old('info')}}"></textarea>
                    <small class="text-info">What are the changes made in this update?</small><br>
                    <x-input-error input-name="info" />
                </div>
            </div>

            <div class="mt-3">
                <label for="file" class="form-label sm:w-56">Upload File</label>
                <div class="w-full">
                    <input id="file" type="file" class="form-control" name="file">
                    <small class="text-info">.apk file only</small><br>
                    <x-input-error input-name="file" />
                </div>
            </div>
        </x-modal-form>
    </div>
@endsection
