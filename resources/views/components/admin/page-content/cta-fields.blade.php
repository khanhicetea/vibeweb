@props([
    'content',
])

<x-admin.card title="CTA" {{ $attributes }}>
    <div class="card-body">
        <x-admin.field label="Title" name="content.cta.title" for="cta-title">
            <x-admin.input
                id="cta-title"
                name="content[cta][title]"
                error="content.cta.title"
                :value="old('content.cta.title', data_get($content, 'cta.title'))"
            />
        </x-admin.field>
        <x-admin.field label="Body" name="content.cta.body" for="cta-body">
            <x-admin.textarea
                id="cta-body"
                name="content[cta][body]"
                error="content.cta.body"
                rows="3"
                :value="old('content.cta.body', data_get($content, 'cta.body'))"
            />
        </x-admin.field>
        <div class="row">
            <x-admin.page-content.button-fields
                label="Button"
                name="cta-button"
                data-prefix="cta.button"
                old-prefix="content.cta.button"
                input-prefix="content[cta][button]"
                :content="$content"
            />
        </div>
    </div>
</x-admin.card>
