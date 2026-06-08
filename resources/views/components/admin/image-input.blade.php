@props([
    'name' => null,
    'value' => '',
    'label' => 'Image',
    'directory' => 'uploads',
    'hint' => null,
    'error' => null,
])

@php
    use Illuminate\Support\Js;

    $errorKey = $error ?? $name;
    $inputId = 'image-input-'.uniqid();
    $fieldAttributes = $attributes
        ->class(['admin-image-input', 'mb-2'])
        ->except(['name', 'x-bind:name']);
@endphp

<div
    {{ $fieldAttributes }}
    x-data="imageInput({{ Js::from([
        'value' => $value,
        'directory' => $directory,
        'uploadUrl' => route('admin.images.store'),
    ]) }})"
    x-modelable="value"
    x-init="label = {{ Js::from($label) }}; inputId = {{ Js::from($inputId) }}"
>
    @include('components.admin.partials.image-input-fields')

    <input
        type="hidden"
        x-model="value"
        @if ($name) name="{{ $name }}" @endif
        {{ $attributes->only(['name', 'x-bind:name']) }}
    >

    @if ($hint)
        <div class="form-hint">{{ $hint }}</div>
    @endif

    @if ($errorKey)
        <x-admin.field-error :name="$errorKey" />
    @endif
</div>