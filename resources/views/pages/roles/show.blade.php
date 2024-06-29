@extends('layouts.simple.master')

@section('title', $role->name . ' Role')

@section('breadcrumb-title')
    <h3>{{ $role->name }} Role</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
    <li class="breadcrumb-item active">{{ $role->name }} Role</li>
@endsection

@section('content')
    <div class="container-fluid" >
        <div class="row">
            <section class="col-12">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6>List of {{ $role->name }} Permissions</h6>
                    <button class="btn btn-primary btn-hover-effect px-3"
                            data-bs-toggle="modal" data-bs-target="#edit-role"
                    >
                        <i class="fa fa-edit"></i>
                        &nbsp;Edit role name & permissions
                    </button>
                </div>

                <div class="card">
                    <div class="card-body">
                        @if($no_permissions = $role->permissions->count() < 1)
                            <div class="text-center">This roles does not have any permission.</div>
                        @else
                            <p class="">
                                @foreach($role->permissions->sortBy('name') as $permission)
                                    {{ ucwords(str($permission->name)->replace('-', ' ')) }}{{ !$loop->last ? ', ' : '.'}}
                                @endforeach
                            </p>
                        @endif
                    </div>
                </div>
            </section>

            <section class="col-12">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6>List of all {{ $role->name }} Users</h6>
                    <button class="btn btn-primary btn-hover-effect px-3"
                            data-bs-toggle="modal" data-bs-target="#assign-role"
                    >
                        <i class="fa fa-user-plus"></i>
                        &nbsp; Assign to New User(s)
                    </button>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="list-product">
                            <table class="table" id="project-status">
                                <thead>
                                <tr>
                                    <th> <span class="f-light f-w-600">Name</span></th>
                                    <th> <span class="f-light f-w-600">Phone</span></th>
                                    <th> <span class="f-light f-w-600 pe-2">Status</span></th>
                                    <th> <span class="f-light f-w-600">Reg. Date</span></th>
                                    <th>
                                        <span class="f-light f-w-600">
                                            <i class="fa fa-cogs"></i>
                                        </span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($role->users as $user)
                                    <tr class="product-removes">
                                        <td>
                                            <x-users.row-data :user="$user" />
                                        </td>
                                        <td>
                                            <p class="f-light">{{ $user->phone }}</p>
                                        </td>
                                        <td>
                                            <x-users.status-badge :$user />
                                        </td>
                                        <td>
                                            <p class="f-light" style="width: 180px">{{ $user->created_at->toDayDateTimeString() }}</p>
                                        </td>
                                        <td class="">
                                            <form action="{{ route('roles.users.destroy', [$role->name, $user]) }}" class="my-form" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center gap-1 px-2 py-1">
                                                    <i class="fa fa-trash"></i> Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Modals -->

    <!-- Edit Role to Users -->
    <div class="modal modal-lg fade" id="edit-role" tabindex="-1" role="dialog" aria-labelledby="edit-role" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('roles.update', $role) }}" class="modal-content my-form" method="post">
                @csrf
                @method('PUT')
                <div class="modal-header fw-medium">
                    Edit Role Name and/or Permissions
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <label for="gender" class="form-label text-secondary">Name</label>
                        <input type="text" class="form-control" name="name"
                               value="{{ old('name') ?? $role->name }}" required
                        />
                        <x-input-error :input-name="$error = 'name'" />
                    </div>

                    <div class="mt-3">
                        <label class="form-label text-secondary fw-medium">Permissions</label>
                        <div class="row px-2">
                            @foreach($permissions as $permission)
                                <div class="col-6 col-sm-4 col-lg-3 form-check mt-2">
                                    <input id="{{ $slug = str($permission)->slug() }}" class="form-check-input" type="checkbox"
                                           name="permissions[]" value="{{ $permission }}"
                                           @if(in_array($permission, $role->permissions->pluck('name')->toArray())) checked @endif
                                    >
                                    <label class="form-check-label" for="{{  $slug }}">{{ ucwords(str($permission)->replace('-', ' ')) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- BEGIN: Slide Over Footer -->
                <div class="modal-footer text-right mt-2">
                    <button class="btn btn-outline-light" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary btn-hover-effect" type="submit">Submit</button>
                </div>
                <!-- END: Slide Over Footer -->
            </form>
        </div>
    </div> <!-- END: Slide Over Content -->

    <!-- Assign Role to Users -->
    <div class="modal fade" id="assign-role" tabindex="-1" role="dialog" aria-labelledby="assign-role" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('roles.users.store', $role->name) }}" class="modal-content my-form" method="post">
                @csrf
                <div class="modal-header fw-medium">
                    Assign {{ $role->name }} role to New User(s)
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <label for="name" class="form-label">Enter Email(s)</label>
                        <div class="w-100">
                            <textarea id="new-user" class="form-control" aria-label="Add new user to role"
                                   name="emails" placeholder="johndoe@test.com,janedoe@test.com" required rows="4"
                            ></textarea>
                            <span class="small text-info">
                                <i class="fa fa-info-circle"></i>
                                Separate multiple user emails with commas
                            </span>
                        </div>
                    </div>
                </div>
                <!-- BEGIN: Slide Over Footer -->
                <div class="modal-footer text-right mt-2">
                    <button class="btn btn-outline-light" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary btn-hover-effect" type="submit">Submit</button>
                </div>
                <!-- END: Slide Over Footer -->
            </form>
        </div>
    </div> <!-- END: Slide Over Content -->
@endsection
