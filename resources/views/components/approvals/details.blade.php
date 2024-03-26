<div class="modal fade" id="view-approval" tabindex="-1" role="dialog" aria-labelledby="view-approval" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- BEGIN: Slide Over Header -->
            <div class="modal-header">
                <h6 class="text-lg font-medium"
                    x-text="`${approval?.resource} was ${approval?.action?.toUpperCase()} by ${approval?.author?.name}`">
                </h6>
            </div>
            <!-- END: Slide Over Header -->
            <div class="modal-body">
                <p class="mb-1">
                    <span class="font-medium" x-text="`Date ${action}:`"></span>
                    <span x-text="(new Date(approval.created_at)).toLocaleString()"></span>
                </p>
                <p x-text="`The details of the ${action} attributes are shown below:`"></p>
                <div class="row mt-2 font-medium text-secondary">
                    <div class="col-4">Attribute</div>
                    <div class="col-4">New value</div>
                    <template x-if="action !== 'created'">
                        <div class="col-4">Old value</div>
                    </template>
                </div>

                <hr>

                <template x-for="key in Object.keys(approval?.new_data ?? {})" :key="key">
                    <div class="d-flex justify-content-between flex-wrap py-1">
                        <div class="font-medium" x-text="key.replace('_', ' ')"></div>
                        <div x-text="JSON.stringify(approval.new_data[key])"></div>
                        <template x-if="action !== 'created'">
                            <div class="text-secondary" x-text="JSON.stringify(approval.original_data[key])"></div>
                        </template>
                    </div>
                </template>
            </div>
            <!-- BEGIN: Slide Over Footer -->
            <div class="modal-footer text-right mt-2">
                <form :action="approvalRoute" method="post" class="my-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger px-5 w-fit spinner-dark">
                        <div class="flex gap-1">
                            <i class="fa fa-thumbs-o-down"></i>
                            Decline
                        </div>
                    </button>
                </form>

                <form :action="approvalRoute" method="post" class="my-form">
                    @csrf
                    @method('PUT')

                    <button type="submit" class="btn btn-success text-white px-5 w-fit">
                        <div class="flex gap-1">
                            <i class="fa fa-thumbs-o-up"></i>
                            Approve
                        </div>
                    </button>
                </form>
            </div>
            <!-- END: Slide Over Footer -->
        </div>
    </div>
</div> <!-- END: Slide Over Content -->
