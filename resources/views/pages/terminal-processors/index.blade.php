@extends('layouts.simple.master')

@section('title', 'Terminal Processors')

@section('breadcrumb-title')
    <h3>Terminal Processors</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Terminal Processors</li>
@endsection

@section('content')
    <div class="row" x-data="{action: '', processor: {}, terminalProcessor: {}}">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex flex-md-row flex-column-reverse gap-2 align-items-md-center">
                    <p class="mb-0 me-auto">Showing list of all Terminal Processors.</p>

                    <button type="button" class="btn btn-primary btn-hover-effect px-3"
                            data-bs-toggle="modal" data-bs-target="#create-processor"
                            x-on:click="action ='{{ route('terminal-processors.store') }}'"
                    >Add Processor</button>
                </div>
                <div class="card-body">
                    <div class="list-product">
                        <table class="table" id="project-status">
                            <thead>
                            <tr>
                                <th> <span class="f-light f-w-600">Serial Number</span></th>
                                <th> <span class="f-light f-w-600" style="width: 110px">Processor</span></th>
                                <th> <span class="f-light f-w-600" style="width: 110px">Terminal ID</span></th>
                                <th> <span class="f-light f-w-600" style="width: 110px">Merchant ID</span></th>
                                <th> <span class="f-light f-w-600" style="width: 130px">Currency Code</span></th>
                                <th> <span class="f-light f-w-600" style="width: 130px">Country Code</span></th>
                                <th> <span class="f-light f-w-600" style="width: 130px">Merchant Code</span></th>
                                <th> <span class="f-light f-w-600" style="width: 80px">Name/Location</span></th>
                                <th> <span class="f-light f-w-600" style="width: 150px">Name/Location</span></th>
                                <th> <span class="f-light f-w-600">Created</span></th>
                                <th data-sortable="false">
                                        <span class="f-light f-w-600">
                                            <i class="fa fa-cogs"></i>
                                        </span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($terminalProcessors as $tp)
                                <tr class="product-removes">
                                    <td>
                                        <p class="f-light">{{ $tp->serial }}</p>
                                    </td>
                                    <td>
                                        <p class="f-light">{{ $tp->processor?->name }}</p>
                                    </td>
                                    <td>
                                        <p class="f-light">{{ $tp->tid }}</p>
                                    </td>
                                    <td>
                                        <p class="f-light">{{ $tp->mid }}</p>
                                    </td>
                                    <td>
                                        <p class="f-light">{{ $tp->currency_code }}</p>
                                    </td>
                                    <td>
                                        <p class="f-light">{{ $tp->country_code }}</p>
                                    </td>
                                    <td>
                                        <p class="f-light">{{ $tp->category_code }}</p>
                                    </td>
                                    <td>
                                        <p class="f-light">{{ $tp->name_location }}</p>
                                    </td>
                                    <td>
                                        <p class="f-light">{{ $tp->name_location }}</p>
                                    </td>
                                    <td>
                                        <p class="f-light" style="width: 100px">{{ $tp->created_at->toDayDateTimeString() }}</p>
                                    </td>

                                    <td>
                                        <div class="product-action">
                                            <button class="btn btn-info btn-sm d-flex align-items-center gap-1 px-2 py-1"
                                                    data-bs-toggle="modal" data-bs-target="#edit-processor"
                                                    x-on:click="action = '{{ route('terminal-processors.update', $tp) }}'; processor = @js($tp);"
                                            >
                                                <i class="fa fa-edit"></i> Edit
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="edit-processor" tabindex="-1" role="dialog" aria-labelledby="edit-terminal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form class="modal-content my-form" :action="action" method="post">
                        @csrf
                        @method('PUT')
                        <div class="modal-header fw-medium">
                            Edit Terminal Processor
                            <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mt-3">
                                <label for="serial" class="form-label">Serial</label>
                                <div class="w-100">
                                    <input id="serial" type="text" class="form-control" name="serial"
                                           x-model="processor.serial"
                                    >
                                    <x-input-error input-name="serial" />
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="terminal_id" class="form-label">Terminal ID</label>
                                <div class="w-100">
                                    <input id="terminal_id" type="text" class="form-control" name="tid"
                                           x-model="processor.tid"
                                    >
                                    <x-input-error input-name="tid" />
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="merchant_id" class="form-label">Merchant ID </label>
                                <div class="w-100">
                                    <input id="merchant_id" type="text" class="form-control" name="mid"
                                           x-model="processor.mid"
                                    >
                                    <x-input-error input-name="mid" />
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="category_code" class="form-label">Category Code</label>
                                <div class="w-100">
                                    <input id="category_code" type="text" class="form-control" name="category_code"
                                           x-model="processor.category_code"
                                    >
                                    <x-input-error input-name="category_code" />
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="name_location" class="form-label">Name Location</label>
                                <div class="w-100">
                                    <input id="name_location" type="text" class="form-control" name="name_location"
                                           x-model="processor.name_location"
                                    >
                                    <x-input-error input-name="name_location" />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-right mt-2">
                            <button class="btn btn-outline-light" type="button" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary btn-hover-effect" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>



            <div class="modal fade" id="create-processor" tabindex="-1" role="dialog" aria-labelledby="create-terminal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form class="modal-content my-form" :action="action" method="post">
                        @csrf
                        <div class="modal-header fw-medium">
                            Create Terminal Processor
                            <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mt-3">
                                <label for="serial" class="form-label">Serial</label>
                                <div class="w-100">
                                    <input id="serial" type="text" class="form-control" name="serial"
                                    >
                                    <x-input-error input-name="serial" />
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="tid" class="form-label">Terminal ID</label>
                                <div class="w-100">
                                    <input id="tid" type="text" class="form-control" name="tid"
                                    >
                                    <x-input-error input-name="tid" />
                                </div>
                            </div>

                            <div class="mt-3">
                                <label for="processor_id" class="form-label w-fit">Processor</label>
                                <div class="w-100">
                                    <select name="processor_id" class="form-select"  required>
                                        @foreach($processors as $processor)
                                            <option value="{{ $processor->id }}">{{ $processor->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error input-name="processor_id" />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-right mt-2">
                            <button class="btn btn-outline-light" type="button" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary btn-hover-effect" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
