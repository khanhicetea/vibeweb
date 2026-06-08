@props([
    'content',
    'secondaryButton' => false,
])

<x-admin.card title="Hero">
    <div class="card-body">
        <x-admin.field label="Eyebrow" name="content.hero.eyebrow" for="hero-eyebrow">
            <x-admin.input
                id="hero-eyebrow"
                name="content[hero][eyebrow]"
                error="content.hero.eyebrow"
                :value="old('content.hero.eyebrow', data_get($content, 'hero.eyebrow'))"
            />
        </x-admin.field>
        <x-admin.field label="Title" name="content.hero.title" for="hero-title">
            <x-admin.input
                id="hero-title"
                name="content[hero][title]"
                error="content.hero.title"
                :value="old('content.hero.title', data_get($content, 'hero.title'))"
            />
        </x-admin.field>
        <x-admin.field label="Lead" name="content.hero.lead" for="hero-lead">
            <x-admin.textarea
                id="hero-lead"
                name="content[hero][lead]"
                error="content.hero.lead"
                rows="4"
                :value="old('content.hero.lead', data_get($content, 'hero.lead'))"
            />
        </x-admin.field>
        <div class="row">
            <x-admin.page-content.button-fields
                label="Primary button"
                name="primary"
                data-prefix="hero.primary_button"
                old-prefix="content.hero.primary_button"
                input-prefix="content[hero][primary_button]"
                :content="$content"
            />

            @if ($secondaryButton)
                <div class="w-100"></div>
                <div class="col-md-6 mt-3">
                    <x-admin.field label="Secondary button label" name="content.hero.secondary_button.label" for="secondary-label" class="mb-0">
                        <x-admin.input
                            id="secondary-label"
                            name="content[hero][secondary_button][label]"
                            error="content.hero.secondary_button.label"
                            :value="old('content.hero.secondary_button.label', data_get($content, 'hero.secondary_button.label'))"
                        />
                    </x-admin.field>
                </div>
                <div class="col-md-6 mt-3">
                    <x-admin.field label="Secondary button URL" name="content.hero.secondary_button.url" for="secondary-url" class="mb-0">
                        <x-admin.input
                            id="secondary-url"
                            name="content[hero][secondary_button][url]"
                            error="content.hero.secondary_button.url"
                            :value="old('content.hero.secondary_button.url', data_get($content, 'hero.secondary_button.url'))"
                        />
                    </x-admin.field>
                </div>
            @endif
        </div>
    </div>
</x-admin.card>
