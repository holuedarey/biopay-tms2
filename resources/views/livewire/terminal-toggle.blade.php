<div class="d-flex flex-column align-items-center gap-2">
    <!-- Status text with dynamic color -->
    <span class="text-sm fw-semibold {{ $isActive ? 'text-success' : 'text-danger' }} transition-colors duration-300">
        {{ $isActive ? 'ON' : 'OFF' }}
    </span>

    <!-- Colorful toggle switch -->
    <button type="button" wire:click="toggleStatus" class="position-relative p-0 border-0 bg-transparent">
        @if ($isActive)
            <!-- Active state (green) -->
            <svg xmlns="http://www.w3.org/2000/svg" width="44" height="24" viewBox="0 0 44 24" class="transition-colors duration-300">
                <rect x="2" y="2" width="40" height="20" rx="10" ry="10" fill="#CBCBCB" stroke="#D1d5db" stroke-width="2" />
                <circle cx="14" cy="12" r="8" fill="#106745" />
                <title>Deactivate</title>
            </svg>
        @else
            <!-- Inactive state (red) -->
            <svg xmlns="http://www.w3.org/2000/svg" width="44" height="24" viewBox="0 0 44 24" class="transition-colors duration-300">
                <rect x="2" y="2" width="40" height="20" rx="10" ry="10" fill="#CBCBCB" stroke="#fff" stroke-width="2" />
                <circle cx="30" cy="12" r="8" fill="red" />
                <title>Activate</title>
            </svg>
        @endif
    </button>
</div>
