@props([
    'name',
    'type' => 'text',
    'value' => null,
    'error' => null,
])

@php
    $errorKey = $error ?? $name;
@endphp

<input
    name="{{ $name }}"
    type="{{ $type }}"
    value="{{ $value }}"
    {{ $attributes->class([
        'form-control',
        'is-invalid' => $errors->has($errorKey),
    ]) }}
>
