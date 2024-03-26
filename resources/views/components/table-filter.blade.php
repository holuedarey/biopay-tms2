@props(['showSearch' => true, 'placeholder' => ''])
@push('style')
{{--    <script src="{{ asset('assets/css/vendors/flatpickr/flatpickr.min.css') }}"></script>--}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
<div x-data class="w-100  d-flex flex-sm-row flex-column gap-2 w-auto mt-3 mt-sm-0 ms-md-auto ms-md-0">
    @if($showSearch)
        <input type="text" class="form-control w-full pr-10" wire:model.debounce.500ms="search"
               placeholder="Search {{ $placeholder }}..." aria-describedby="Search" aria-label="Search"
        >
    @endif

        <div class="input-group flatpicker-calender">
            <input class="form-control" id="range-date" type="date"
                   placeholder="Start date - End date"
                   wire:model="date" aria-label="Date range filter"
            >
        </div>
    <button class="btn btn-primary px-2 h-25" @click="$wire.filterDate($('#range-date').val())">Apply</button>
    <button class="btn btn-outline-light px-2 h-25" @click="$wire.filterDate()">Clear</button>
</div>

@push('script')
    <script src="{{ asset('assets/js/flat-pickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/js/flat-pickr/custom-flatpickr.js') }}"></script>
@endpush