<x-admin.repeatable-list
    title="Stats"
    add-label="Add stat"
    singular="Stat"
    max="6"
    error-key="items"
    :items="$items"
    :fallback="['value' => '', 'label' => '', 'count' => '', 'suffix' => '']"
>
    <label class="form-label" :for="`stat-value-${index}`">Value</label>
    <input :id="`stat-value-${index}`" :name="`items[${index}][value]`" x-model="item.value" class="form-control mb-2">
    <label class="form-label" :for="`stat-label-${index}`">Label</label>
    <input :id="`stat-label-${index}`" :name="`items[${index}][label]`" x-model="item.label" class="form-control mb-2">
    <div class="row">
        <div class="col-6">
            <label class="form-label" :for="`stat-count-${index}`">Count (optional)</label>
            <input :id="`stat-count-${index}`" :name="`items[${index}][count]`" x-model="item.count" class="form-control">
        </div>
        <div class="col-6">
            <label class="form-label" :for="`stat-suffix-${index}`">Suffix</label>
            <input :id="`stat-suffix-${index}`" :name="`items[${index}][suffix]`" x-model="item.suffix" class="form-control">
        </div>
    </div>
</x-admin.repeatable-list>