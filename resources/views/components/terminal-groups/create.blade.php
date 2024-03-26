<div>
    <x-modal-form id="add-terminal" action="{{ route('terminal-groups.store') }}">
        <x-slot:header> Add New Terminal Group</x-slot:header>
        <div>
            <div class="mt-3">
                <label for="name" class="form-label sm:w-24">Name</label>
                <div class="w-full">
                    <input id="name" type="text" class="form-control" placeholder="Enter the group name" name="name" value="{{ old('name') }}">
                    <x-input-error input-name="name" />
                </div>
            </div>
            <div class="mt-3">
                <label for="info" class="form-label sm:w-24">Description</label>
                <div class="w-full">
                    <textarea name="info" id="info" rows="4" class="form-control" placeholder="Enter a brief description..."></textarea>
                    <x-input-error input-name="info" />
                </div>
            </div>
        </div>
    </x-modal-form>
</div>
