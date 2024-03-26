<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form {{ $attributes->merge(['method' => 'post', 'class' => 'modal-content my-form']) }}>
            @csrf
            <div class="modal-header fw-medium">
                {{ $header }}
                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer text-right mt-2">
                <button class="btn btn-outline-light" type="button" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary btn-hover-effect" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>