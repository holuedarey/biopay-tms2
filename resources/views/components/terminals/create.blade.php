@props(['group' => null, 'user' => null, 'email'=> null])
<div>
    <x-modal-form id="add-terminal" action="{{ route('terminals.store') }}">
        <x-slot:header> Add New Terminal</x-slot:header>
        <div>
            @if($user)
                <input type="hidden" name="email" value="{{ $user->email }}">
            @elseif($email)
                <div class="mt-3">
                    <label for="email" class="form-label">Agent's Email</label>
                    <div class="w-100">
                        <input id="email" type="email" class="form-control" placeholder="example@gmail.com" name="email" value="{{ $email }}">
                        <x-input-error input-name="email" />
                    </div>
                </div>
            @else
                <div class="mt-3">
                    <label for="email" class="form-label">Agent's Email</label>
                    <div class="w-100">
                        <input id="email" type="email" class="form-control" placeholder="example@gmail.com" name="email" value="{{ old('email') ?? request('agent')}}">
                        <x-input-error input-name="email" />
                    </div>
                </div>
            @endif

            @if($group)
                <input type="hidden" name="group_id" value="{{ $group->id }}">
            @else
                <div class="mt-4">
                    <label for="group" class="form-label">Group</label>
                    <div class="w-100">
                        <select name="group_id" id="group" class="form-select">
                            <option selected disabled> --- Select Terminal Group --- </option>
                            @foreach(app('terminal_groups') as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error input-name="group_id" />
                    </div>
                </div>
            @endif
            <div class="mt-3">
                <label for="device" class="form-label">Device</label>
                <div class="w-100">
                    <input id="device" type="text" class="form-control" placeholder="Enter the device name" name="device" value="{{ old('device') }}">
                    <x-input-error input-name="device" />
                </div>
            </div>
            <div class="mt-3">
                <label for="terminal_id" class="form-label">Terminal ID</label>
                <div class="w-100">
                    <input id="terminal_id" type="text" class="form-control" placeholder="Enter Terminal ID" name="tid" value="{{ old('tid') }}">
                    <x-input-error input-name="tid" />
                </div>
            </div>
            <div class="mt-3">
                <label for="merchant_id" class="form-label">Merchant ID </label>
                <div class="w-100">
                    <input id="merchant_id" type="text" class="form-control" placeholder="Enter Merchant ID" name="mid" value="{{ old('mid') }}">
                    <x-input-error input-name="mid" />
                </div>
            </div>
            <div class="mt-3">
                <label for="serial_no" class="form-label">Serial</label>
                <div class="w-100">
                    <input id="serial_no" type="text" class="form-control" placeholder="Enter the device serial number" name="serial" value="{{ old('serial') }}">
                    <x-input-error input-name="serial" />
                </div>
            </div>
        </div>
    </x-modal-form>
</div>
