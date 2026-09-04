<x-admin.repeatable-list
    title="Roles"
    add-label="Add role"
    singular="Role"
    columns="2"
    max="12"
    error-key="items"
    :items="$items"
    :fallback="['title' => '', 'type' => '', 'location' => '', 'summary' => '']"
>
    <div class="mb-3">
        <label class="form-label" :for="`role-title-${index}`">Title</label>
        <input :id="`role-title-${index}`" :name="`items[${index}][title]`" x-model="item.title" class="form-control" placeholder="Growth Lead">
    </div>
    <div class="mb-3">
        <label class="form-label" :for="`role-type-${index}`">Type</label>
        <input :id="`role-type-${index}`" :name="`items[${index}][type]`" x-model="item.type" class="form-control" placeholder="Full-time, Contract…">
    </div>
    <div class="mb-3">
        <label class="form-label" :for="`role-location-${index}`">Location</label>
        <input :id="`role-location-${index}`" :name="`items[${index}][location]`" x-model="item.location" class="form-control" placeholder="Chicago or remote (US)">
    </div>
    <div class="mb-0">
        <label class="form-label" :for="`role-summary-${index}`">Summary</label>
        <textarea :id="`role-summary-${index}`" :name="`items[${index}][summary]`" x-model="item.summary" class="form-control" rows="3"></textarea>
    </div>
</x-admin.repeatable-list>
