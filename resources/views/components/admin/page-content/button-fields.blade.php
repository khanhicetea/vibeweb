@props([
    'label',
    'name',
    'content',
    'dataPrefix',
    'oldPrefix',
    'inputPrefix',
])

<div class="col-md-6">
    <x-admin.field :label="$label.' label'" :name="$oldPrefix.'.label'" :for="$name.'-label'" class="mb-0">
        <x-admin.input
            id="{{ $name }}-label"
            name="{{ $inputPrefix }}[label]"
            :error="$oldPrefix.'.label'"
            :value="old($oldPrefix.'.label', data_get($content, $dataPrefix.'.label'))"
        />
    </x-admin.field>
</div>
<div class="col-md-6">
    <x-admin.field :label="$label.' URL'" :name="$oldPrefix.'.url'" :for="$name.'-url'" class="mb-0">
        <x-admin.input
            id="{{ $name }}-url"
            name="{{ $inputPrefix }}[url]"
            :error="$oldPrefix.'.url'"
            :value="old($oldPrefix.'.url', data_get($content, $dataPrefix.'.url'))"
        />
    </x-admin.field>
</div>
