<div class="modal fade" id="edit-service" tabindex="-1" role="dialog" aria-labelledby="edit-service" aria-hidden="true">
    <div class="modal-dialog">
        <form :action="action" class="modal-content my-form" method="post">
            <div class="modal-header fw-medium">
                Update Service Info
                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @csrf
                @method('PUT')

                <div class="mt-3">
                    <label for="name" class="form-label">Name</label>
                    <div class="w-100">
                        <input id="name" type="text" class="form-control"
                               name="name" x-model="service.name"/>
                    </div>
                </div>

                <div class="mt-3">
                    <label for="info" class="form-label">Description</label>
                    <div class="w-100">
                        <textarea id="info" class="form-control" rows="4" required
                                  placeholder="Enter service description"
                                  name="description" x-model="service.description"
                        ></textarea>
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