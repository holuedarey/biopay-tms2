@props(['value', 'color' => null])

@php($color = is_null($color) ? 'badge-info text-white' : "badge-light-$color text-$color")

<span {{ $attributes->merge(['class' => "badge $color"]) }}>
    {{ isset($value) ? strtoupper($value) : $slot }}
</span>
