<div>
    <div class="form-check form-switch" title="{{ $service->is_available ? 'Deactivate' : 'Activate' }}">
        <input id="checkbox-switch-7" class="form-check-input" type="checkbox" style="cursor: pointer"
               @checked($service->is_available) wire:click="update" wire:key="{{ $service->id }}"
        >
    </div>
</div>
