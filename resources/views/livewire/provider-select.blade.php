<div class="d-flex align-items-end">
    <div class="w-50">
        <select class="form-select form-control" name="provider"  id="provider" wire:model="provider_id"
                @change="$wire.update()"
        >
            <option value="" selected>-- Select Provider --</option>
            @forelse($service->providers as $provider)
                <option value="{{ $provider->id }}">{{ $provider->name }}</option>
            @empty
                <option value="" disabled selected>No Provider</option>
            @endforelse
        </select>
    </div>
</div>
