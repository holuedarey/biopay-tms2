@props(['terminals', 'group' => null])
<div class="container-fluid" x-data="terminal_update">
    <div class="row">
        <!-- Individual column searching (text inputs) Starts-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex flex-md-row flex-column-reverse gap-2 align-items-md-center">
                    <p class="mb-0 me-auto">Showing list of all terminals.</p>
                    @can('create', \App\Models\Terminal::class)
                        <button type="button"
                                class="btn btn-primary btn-hover-effect d-flex justify-content-center align-items-center gap-2 px-3"
                                data-bs-toggle="modal" data-bs-target="#add-terminal"
                        >
                            <i data-feather="plus-square" style="height: 15px"></i>
                            <span>Add New Terminal</span>
                        </button>
                    @endcan
                </div>

                <div class="card-body">
                    <div class="list-product">
                        <table class="table" id="project-status">
                            <thead>
                            <tr>
                                <th> <span class="f-light f-w-600">Agent</span></th>
                                <th> <span class="f-light f-w-600" style="width: 110px">Terminal ID</span></th>
                                <th> <span class="f-light f-w-600">Merchant ID</span></th>
                                <th> <span class="f-light f-w-600">Serial/Device</span></th>
                                <th> <span class="f-light f-w-600" style="width: 80px">Status</span></th>
                                <th> <span class="f-light f-w-600">Created</span></th>
                                <th data-sortable="false">
                                        <span class="f-light f-w-600">
                                            <i class="fa fa-cogs"></i>
                                        </span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($terminals as $terminal)
                                <tr class="product-removes">
                                    <td>
                                        <x-users.row-data :user="$terminal->agent" />
                                    </td>
                                    <td>
                                        <p class="f-light">{{ $terminal->tid }}</p>
                                    </td>
                                    <td>
                                        <p class="f-light">{{ $terminal->mid }}</p>
                                    </td>
                                    <td>
                                        <p class="f-light">
                                            {{ $terminal->serial }}<br/>
                                            <span class="small">{{ $terminal->device }}</span>
                                        </p>
                                    </td>
                                    <td>
                                        <livewire:status-toggle-badge :model="$terminal" />
                                    </td>
                                    <td>
                                        <p class="f-light" style="width: 100px">{{ $terminal->created_at->toDayDateTimeString() }}</p>
                                    </td>

                                    <td>
                                        <div class="product-action">
                                            <button class="btn btn-info btn-sm d-flex align-items-center gap-1 px-2 py-1"
                                                    data-bs-toggle="modal" data-bs-target="#edit-terminal"
                                                    x-on:click="action = '{{ route('terminals.update', $terminal) }}'; terminal = @js($terminal);"
                                            >
                                                <i class="fa fa-edit"></i> Edit
                                            </button>
                                            <button class="btn btn-primary btn-sm d-flex align-items-center gap-1 px-2 py-1"
                                                    data-bs-toggle="modal" data-bs-target="#edit-menus"
                                                    x-on:click="initializeModal('{{ route('terminals.menus.index', $terminal) }}')"
                                            >
                                                <i class="fa fa-list"></i> Menus
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
        </div>
        <!-- Individual column searching (text inputs) Ends-->
    </div>

    @can('create', \App\Models\Terminal::class)
        <x-terminals.create :$group />
    @endcan

    <x-terminals.edit />
    <x-terminals.menus />
</div>
