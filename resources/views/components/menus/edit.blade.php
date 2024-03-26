<div class="modal fade" id="edit-menu" tabindex="-1" role="dialog" aria-labelledby="edit-menu" aria-hidden="true">
    <div class="modal-dialog">
        <form :action="action" class="modal-content my-form" method="post">
            <div class="modal-header fw-medium">
                Edit Menu Name
                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @csrf
                @method('PUT')

                <div class="mt-3">
                    <label for="name" class="form-label">Name</label>
                    <div class="w-100">
                        <input id="menu_name" type="text" class="form-control"
                               name="menu_name" x-model="menu.menu_name"/>
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
