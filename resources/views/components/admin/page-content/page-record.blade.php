@props([
    'pageContent',
])

<x-admin.card title="Page record" {{ $attributes }}>
    @isset($headerActions)
        <x-slot:headerActions>
            {{ $headerActions }}
        </x-slot:headerActions>
    @endisset

    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">Key</label>
            <x-admin.input name="page_content_key" :value="$pageContent->key" disabled />
        </div>
        <x-admin.field label="Description" name="description" for="description">
            <x-admin.textarea
                id="description"
                name="description"
                rows="4"
                :value="old('description', $pageContent->description)"
            />
        </x-admin.field>
    </div>
</x-admin.card>
