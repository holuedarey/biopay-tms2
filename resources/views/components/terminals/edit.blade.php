<div class="modal fade" id="edit-terminal" tabindex="-1" role="dialog" aria-labelledby="edit-terminal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content my-form" :action="action" method="post">
            @csrf
            @method('PUT')
            <div class="modal-header fw-medium">
                Edit Terminal
                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-3">
                    <label for="group" class="form-label">Group</label>
                    <div class="w-100">
                        <select name="group_id" id="group" class="form-select" x-model="terminal.group_id">
                            @foreach(app('terminal_groups') as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error input-name="group_id" />
                    </div>
                </div>
                <div class="mt-3">
                    <label for="device" class="form-label">Device</label>
                    <div class="w-100">
                        <input id="device" type="text" class="form-control" name="device"
                               x-model="terminal.device"
                        >
                        <x-input-error input-name="device" />
                    </div>
                </div>
                <div class="mt-3">
                    <label for="terminal_id" class="form-label">Terminal ID</label>
                    <div class="w-100">
                        <input id="terminal_id" type="text" class="form-control" name="tid"
                               x-model="terminal.tid"
                        >
                        <x-input-error input-name="tid" />
                    </div>
                </div>
                <div class="mt-3">
                    <label for="merchant_id" class="form-label">Merchant ID </label>
                    <div class="w-100">
                        <input id="merchant_id" type="text" class="form-control" name="mid"
                               x-model="terminal.mid"
                        >
                        <x-input-error input-name="mid" />
                    </div>
                </div>
                <div class="mt-3">
                    <label for="serial_no" class="form-label">Serial</label>
                    <div class="w-100">
                        <input id="serial_no" type="text" class="form-control" name="serial"
                               x-model="terminal.serial"
                        >
                        <x-input-error input-name="serial" />
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