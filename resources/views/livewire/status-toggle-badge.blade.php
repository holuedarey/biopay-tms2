<div>
    <div @class([
        'badge d-flex justify-content-between py-0 align-items-center w-fit',
        'badge-light-success' => $model->is_active,
        'badge-light-danger' => !$model->is_active
])>{{ $model->status }}
        @can("edit {$model->getTable()}")
            @if($model->is_active)
                <span class="ps-1" data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      data-bs-original-title="Suspend"
                      wire:click="updateStatus"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather text-success feather-toggle-right"><rect x="1" y="5" width="22" height="14" rx="7" ry="7"></rect><circle cx="16" cy="12" r="3"></circle></svg>
                </span>
            @else
                <span class="ps-1" data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      data-bs-original-title="Activate"
                      wire:click="updateStatus"  wire:ignore
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-toggle-left"><rect x="1" y="5" width="22" height="14" rx="7" ry="7"></rect><circle cx="8" cy="12" r="3"></circle></svg>
                </span>
            @endif
        @endcan
    </div>
</div>