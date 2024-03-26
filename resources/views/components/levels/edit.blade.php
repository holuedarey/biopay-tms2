<div class="modal fade" id="edit-level" tabindex="-1" role="dialog" aria-labelledby="edit-terminal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content my-form" :action="action" method="post">
            @csrf
            @method('PUT')
            <div class="modal-header fw-medium">
                Edit Level
                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <x-note message="The daily limit must be less than the maximum balance and the single transaction limit must be less than the daily limit"/>

                <div class="mt-3">
                    <label for="name" class="form-label sm:w-56">Level Name</label>
                    <div class="w-100">
                        <input id="name" type="text" class="form-control" name="name" x-model="level.name">
                        <x-input-error input-name="name" />
                    </div>
                </div>

                <div class="mt-3">
                    <label for="max_balance" class="form-label sm:w-56">Maximum Balance</label>
                    <div class="w-100">
                        <input id="max_balance" type="text" class="form-control" name="max_balance" x-model="level.max_balance">
                    </div>
                </div>

                <div class="mt-3">
                    <label for="daily_limit" class="form-label sm:w-56">Daily Limit</label>
                    <div class="w-100">
                        <input id="daily_limit" type="text" class="form-control" name="daily_limit" x-model="level.daily_limit">
                    </div>
                </div>

                <div class="mt-3">
                    <label for="single_trans_max" class="form-label sm:w-56">Single Transaction Maximum</label>
                    <div class="w-100">
                        <input id="single_trans_max" type="text" class="form-control" name="single_trans_max" x-model="level.single_trans_max">
                    </div>
                </div>

                <div class="mt-3">
                    <label for="single_trans_max" class="form-label sm:w-56">Required Document</label>
                    <div class="w-100">
                        <input id="single_trans_max" type="text" class="form-control" name="single_trans_max" x-model="level.single_trans_max">
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