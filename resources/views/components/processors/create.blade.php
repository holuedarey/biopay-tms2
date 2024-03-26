<div class="modal fade" id="create-processor" tabindex="-1" role="dialog" aria-labelledby="create-processor" aria-hidden="true">
    <div class="modal-dialog">
        <form :action="action" class="modal-content my-form" method="post">
            <div class="modal-header fw-medium">
                Create Processor
                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @csrf

                <div class="mt-3">
                    <label for="name" class="form-label">Name</label>
                    <div class="w-100">
                        <input id="name" type="text" class="form-control"
                               name="name"/>
                    </div>
                </div>
                <div class="mt-3">
                    <label for="host" class="form-label">Host</label>
                    <div class="w-100">
                        <input id="host" type="text" class="form-control"
                               name="host"/>
                    </div>
                </div>
                <div class="mt-3">
                    <label for="port" class="form-label">Port</label>
                    <div class="w-100">
                        <input id="port" type="text" class="form-control"
                               name="port"/>
                    </div>
                </div>
                <div class="mt-3">
                    <label for="comp1" class="form-label">Component Key 1</label>
                    <div class="w-100">
                        <input id="comp1" type="text" class="form-control"
                               name="comp1"/>
                    </div>
                </div>
                <div class="mt-3">
                    <label for="comp2" class="form-label">Component Key 2</label>
                    <div class="w-100">
                        <input id="comp2" type="text" class="form-control"
                               name="comp2"/>
                    </div>
                </div>
                <div class="mt-3">
                    <label for="zpk" class="form-label">Zone Pin Key</label>
                    <div class="w-100">
                        <input id="zpk" type="text" class="form-control"
                               name="zpk"/>
                    </div>
                </div>
                <div class="d-flex mt-3 gap-4" x-data="{ ssl: false, requiresKey: false }">
                    <div class="form-check form-switch">
                        <label class="form-check-label" for="ssl">SSL</label>
                        <input type="hidden" name="ssl" x-bind:value="ssl ? '1' : '0'">
                        <input class="form-check-input" id="sslCheckbox" type="checkbox" role="switch" x-model="ssl">
                    </div>

                    <div class="form-check form-switch m-l-10">
                        <label class="form-check-label" for="requiresKey">Requires Key Download</label>
                        <input type="hidden" name="requiresKey" x-bind:value="requiresKey ? '1' : '0'">
                        <input class="form-check-input" id="requiresKeyCheckbox" type="checkbox" role="switch" x-model="requiresKey">
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

