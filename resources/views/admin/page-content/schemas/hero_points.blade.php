<x-admin.repeatable-list
    title="Hero highlights"
    add-label="Add highlight"
    singular="Highlight"
    max="6"
    error-key="items"
    :items="collect($items)->map(fn ($item) => is_array($item) ? $item : ['value' => $item])->values()->all()"
    :fallback="['value' => '']"
>
    <input :name="`items[${index}][value]`" x-model="item.value" class="form-control" placeholder="e.g. Demand generation">
</x-admin.repeatable-list>