@props([
    'label',
    'name',
    'for' => null,
    'hint' => null,
    'error' => null,
])

@php
    $errorKey = $error ?? $name;
@endphp

<div {{ $attributes->class(['mb-3']) }}>
    <label class="form-label" @if ($for) for="{{ $for }}" @endif>{{ $label }}</label>

    {{ $slot }}

    <x-admin.field-error :name="$errorKey" />

    @if ($hint)
        <div class="form-hint">{{ $hint }}</div>
    @endif
</div>
