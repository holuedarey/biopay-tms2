<div class="row">
    <div class="d-flex flex-md-row flex-column-reverse align-items-md-center gap-3 mb-3">
        <p class="mb-0 me-auto">Showing list of all {{ str($name)->lower()->plural() }}</p>
        <input type="text" class="form-control form-control-search bg-transparent w-auto" wire:model.debounce.500ms="search"
               placeholder="Search first name, last name, email, phone..." aria-describedby="Search" aria-label="Search"
        >
        @can('create', \App\Models\User::class)
            <a href="{{ route('agents.onboard') }}" class="btn btn-primary btn-hover-effect d-flex align-items-center justify-content-center gap-2 px-3">
                <i data-feather="user-plus" style="height: 15px"></i>
                <span>Onboard New {{ str($name)->lower()->ucfirst() }}</span>
            </a>
        @endcan

    </div>
    @foreach($users as $user)
        <div class="col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4">
            <div class="card social-profile">
                <div class="card-body">
                    <a href="{{ route('users.show', $user) }}" class="d-block">
                        <div class="social-img-wrap">
                            <div class="social-img"><img src="{{ $user->avatar }}" alt="profile"></div>
                            <div class="edit-icon mb-2">
                                <div class="bg-white px-1 rounded-circle">
                                    @switch($user->status)
                                        @case('ACTIVE')
                                            <i class="fa fa-check-circle text-success"></i>
                                            @break
                                        @case('SUSPENDED')
                                            <i class="fa fa-minus-circle text-warning"></i>
                                            @break
                                        @default
                                            <i class="fa fa-times-circle text-danger"></i>
                                    @endswitch
                                </div>
                            </div>
                        </div>
                        <div class="social-details">
                            <h5 class="mb-1"><a href="{{ route('users.show', $user) }}">{{ $user->name }}</a></h5>
                            <a href="mailto:{{ $user->email }}" class="f-light">{{ $user->email }}</a>
                            <br>
                            <a href="tel:{{ $user->phone }}" target="_blank"><i class="fa fa-phone"></i> {{ $user->phone }}</a>
                            <ul class="social-follow d-flex justify-content-center">
                                <li>
                                    <x-badge>{{ $user->kycLevel->name }}</x-badge>
                                </li>
                                <li>
                                    <x-users.status-badge :$user />
                                </li>
                            </ul>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    @endforeach

    <div>
        {{ $users->links() }}
    </div>
</div>