@props([
    'name',
    'value' => null,
    'error' => null,
    'rows' => 3,
])

@php
    $errorKey = $error ?? $name;
@endphp

<textarea
    name="{{ $name }}"
    rows="{{ $rows }}"
    {{ $attributes->class([
        'form-control',
        'is-invalid' => $errors->has($errorKey),
    ]) }}
>{{ $slot->isEmpty() ? $value : $slot }}</textarea>
