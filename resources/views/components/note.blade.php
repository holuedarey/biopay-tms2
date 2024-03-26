<div class="alert alert-light-warning rounded" role="alert">
    <div {{ $attributes->merge(['class' => 'txt-warning d-flex gap-1 align-items-start']) }}>
        <i class="fa fa-exclamation-circle mt-1"></i>{{ $message ?? $slot }}
    </div>
</div>