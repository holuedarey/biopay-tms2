@props(['inputName'])
@error($inputName)
<p {{ $attributes->merge(['class' => 'text-danger small mt-2 mb-0']) }}>{{ $message }}</p>
@enderror
