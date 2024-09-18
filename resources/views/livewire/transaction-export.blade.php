<div>
    <div class="d-flex align-items-center">
        <input type="text" id="start_date" wire:model="start_date" class="form-control datepicker" placeholder="Start Date" autocomplete="off">
        <input type="text" id="end_date" wire:model="end_date" class="form-control datepicker" placeholder="End Date" autocomplete="off">

        <!-- Added margin-left class to the button -->
        <button wire:click="export" class="btn btn-primary mr-3">Download CSV</button>
    </div>

    @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
    @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror
</div>

<script>
    document.addEventListener('livewire:load', function () {
        // Initialize Flatpickr for start_date
        flatpickr('#start_date', {
            dateFormat: 'Y-m-d',
            onChange: function(selectedDates, dateStr, instance) {
            @this.set('start_date', dateStr);
            }
        });

        // Initialize Flatpickr for end_date
        flatpickr('#end_date', {
            dateFormat: 'Y-m-d',
            onChange: function(selectedDates, dateStr, instance) {
            @this.set('end_date', dateStr);
            }
        });
    });
</script>
