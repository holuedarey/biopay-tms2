<div class="modal fade" id="edit-group" tabindex="-1" role="dialog" aria-labelledby="edit-terminal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content my-form" :action="action" method="post">
            @csrf
            @method('PUT')
            <div class="modal-header fw-medium">
                Edit Terminal Group
                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-3">
                    <label for="name" class="form-label sm:w-24">Name</label>
                    <div class="w-full">
                        <input id="name" type="text" class="form-control" name="name" x-model="group.name">
                        <x-input-error input-name="name" />
                    </div>
                </div>
                <div class="mt-3">
                    <label for="info" class="form-label sm:w-24">Description</label>
                    <div class="w-full">
                        <textarea name="info" id="info" rows="4" class="form-control"  x-model="group.info"></textarea>
                        <x-input-error input-name="info" />
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