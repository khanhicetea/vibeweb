@props([
    'name' => 'images',
    'values' => [],
    'max' => null,
    'label' => 'Images',
    'singular' => 'Image',
    'addLabel' => 'Add image',
    'directory' => 'uploads',
    'error' => null,
])

@php
    use Illuminate\Support\Js;

    $errorKey = $error ?? $name;
@endphp

<div
    {{ $attributes->class(['admin-images-input', 'mb-3']) }}
    x-data="imagesInput({{ Js::from([
        'values' => $values,
        'max' => $max,
        'name' => $name,
        'directory' => $directory,
        'uploadUrl' => route('admin.images.store'),
    ]) }})"
>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <label class="form-label mb-0">{{ $label }}</label>
        <button
            class="btn btn-sm"
            type="button"
            x-on:click="add()"
            @if ($max) :disabled="images.length >= {{ $max }}" @endif
        >
            <i class="ti ti-plus icon" aria-hidden="true"></i>
            {{ $addLabel }}
        </button>
    </div>

    <template x-for="(image, index) in images" :key="image.id">
        <div class="admin-images-input__item border rounded p-3 mb-3">
            <div class="d-flex justify-content-between gap-2 mb-3">
                <strong x-text="`{{ $singular }} ${index + 1}`"></strong>
                <div class="btn-actions">
                    <button class="btn-action" type="button" x-on:click="move(index, -1)" :disabled="index === 0" title="Move up">
                        <i class="ti ti-arrow-up icon" aria-hidden="true"></i>
                    </button>
                    <button class="btn-action" type="button" x-on:click="move(index, 1)" :disabled="index === images.length - 1" title="Move down">
                        <i class="ti ti-arrow-down icon" aria-hidden="true"></i>
                    </button>
                    <button class="btn-action text-danger" type="button" x-on:click="remove(index)" :disabled="images.length === 1" title="Remove">
                        <i class="ti ti-trash icon" aria-hidden="true"></i>
                    </button>
                </div>
            </div>

            <div
                class="admin-image-input"
                x-data="imageInput({
                    value: image.path,
                    directory,
                    uploadUrl,
                })"
                x-init="label = ''; inputId = `images-input-${image.id}`; $watch('value', (path) => image.path = path)"
            >
                @include('components.admin.partials.image-input-fields')

                <input type="hidden" x-model="value" x-bind:name="`${name}[${index}]`">
            </div>
        </div>
    </template>

    @if ($errorKey)
        <x-admin.field-error :name="$errorKey" />
    @endif
</div>