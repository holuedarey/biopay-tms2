<div class="modal fade" id="create-provider" tabindex="-1" role="dialog" aria-labelledby="create-provider" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('providers.store') }}" class="modal-content my-form" method="post">
            @csrf
            <div class="modal-header fw-medium">
                Add new provider
                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-3">
                    <label for="name" class="form-label">Provider Name</label>
                    <div class="w-100">
                        <input id="name" type="text" class="form-control"
                               placeholder="Enter the provider name"
                               name="name" required
                        />
                    </div>
                </div>

                <div class="mt-3">
                    <label for="info" class="form-label">Service</label>
                    <div class="w-100">
                        <select data-placeholder="Select preferred services for provider" name="services[]" class="tom-select w-full" multiple required>
                            <option value="" disabled selected></option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error input-name="services" />
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

@push('style')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
@endpush

@push('script')
    <script>
        new TomSelect(".tom-select");
    </script>
@endpush