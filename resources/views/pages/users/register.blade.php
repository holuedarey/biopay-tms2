@extends('layouts.simple.master')

@section('title', $title)

@push('style')
    {{--    <script src="{{ asset('assets/css/vendors/flatpickr/flatpickr.min.css') }}"></script>--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('breadcrumb-title')
    <h3>{{ $title }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    @if(str_contains($title, 'Admin'))
        <li class="breadcrumb-item"><a href="{{ route('admins.index') }}">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Registration</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">Onboarding</li>
    @endif
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row gap-6 mt-3"
             x-data="{role: '{{ old('role', '') }}', super_agent: '{{ old('super_agent_id', '') }}'}"
             x-init="$watch('role', (value) => super_agent = null)"
        >
            <div class="col-12 col-xl-10">
                <div class="card">

                    <div class="card-header">
                        <h6>Add a new {{ str($title)->before(' ') }} to the system</h6>
                    </div>
                    <!-- BEGIN: Form Layout -->
                    <form class="my-form" method="post" action="{{ route('users.store') }}">
                        @csrf
                        <div class="card-body">
                            <div>
                                <label class="form-label">Name</label>
                                <div class="d-flex flex-md-row flex-column gap-3 justify-content-between">
                                    <div class="w-100">
                                        <input type="text" class="form-control" placeholder="First Name" aria-label="admin first name"
                                               name="first_name" value="{{ old('first_name') }}" required
                                        />
                                    </div>

                                    <div class="w-100">
                                        <input type="text" class="form-control" placeholder="Other Names (Surname first)" aria-label="admin first name"
                                               name="other_names" value="{{ old('other_names') }}" required
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-md-row flex-column gap-3 justify-content-between mt-3">
                                <div class="w-100">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="text" class="form-control" id="email" placeholder="example@test.com" aria-label="admin's email address"
                                           name="email" value="{{ old('email') }}"
                                    />
                                </div>
                                <div class="w-100">
                                    <label class="form-label" for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" placeholder="08123456789" aria-label="admin's phone number"
                                           name="phone" value="{{ old('phone') }}"
                                    />
                                </div>
                                <div class="w-100">
                                    <label class="form-label" id="state">State</label>
                                    <select class="form-control" id="state" name="state" >
                                        <option disabled selected>-- Select State of Residence --</option>
                                        @foreach(config('states') as $state)
                                            <option value="{{ $state }}" @selected(old('state') == $state)>
                                                {{ $state }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex flex-md-row flex-column gap-3 justify-content-between mt-3">
                                <div class="w-100">
                                    <label class="form-label" id="address">Address</label>
                                    <input type="text" class="form-control" id="address" placeholder="Enter admin's street address" aria-label="admin's street address"
                                           name="address" value="{{ old('address') }}"
                                    />
                                </div>

                                <div class="w-100">
                                    <label class="form-label" for="phone">BVN</label>
                                    <input type="text" class="form-control" id="bvn" placeholder="Enter Bvn" aria-label="admin's BVN number"
                                           name="bvn" value="{{ old('bvn') }}"
                                    />
                                </div>
                            </div>
                            <div class="d-flex flex-md-row flex-column gap-3 justify-content-between mt-3">
                                <div class="w-100">
                                    <label class="form-label" id="type">Role</label>
                                    <select class="form-select" aria-label="Select admin Type" name="role" x-model="role" id="type">
                                        <option selected> --- Select Role ---</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role }}">{{ $role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-100">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="gender" aria-label="Select admin Gender" name="gender">
                                        <option disabled selected> --- Select Gender ---</option>
                                        <option value="MALE" @if(old('gender') == 'MALE') selected @endif>Male</option>
                                        <option value="FEMALE" @if(old('gender') == 'FEMALE') selected @endif>Female</option>
                                    </select>
                                </div>
                                <div class="w-100">
                                    <label for="dob" class="form-label">Date of Birth</label>

                                    <div class=" mx-auto">
                                        <div class="input-group flatpicker-calender">
                                            <input class="form-control" id="datetime-local" type="date" name="dob" value="{{ old('dob') ?? ' ' }}"
                                                   placeholder="yyyy-mm-dd" min="{{ now()->subYears(18)->toDateString() }}"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-md-row flex-column gap-3 justify-content-between mt-3">
                                <div class="w-100">
                                    <div x-show="role === '{{ \App\Models\Role::AGENT }}'" x-transition>
                                        <label for="super_agent_id" class="form-label">{{ \App\Models\Role::SUPERAGENT }} (optional)</label>
                                        <select id="super_agent_id" class="js-example-basic-single form-select w-full"
                                                name="super_agent_id" x-model="super_agent"
                                        >
                                            <option value=""></option>
                                            @foreach($super_agents as $super_agent)
                                                <option value="{{ $super_agent->id }}">{{ $super_agent->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end gap-2 mt-10 pt-6 border-t">
                                <button type="reset" class="btn btn-outline-light w-24 mr-1">Reset</button>
                                <button type="submit" class="btn btn-primary btn-hover-effect w-24">Register</button>
                            </div>
                        </div>
                    </form>
                    <!-- END: Form Layout -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/flat-pickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/js/flat-pickr/custom-flatpickr.js') }}"></script>
@endpush
