<x-admin.repeatable-list
    title="Open roles"
    add-label="Add role"
    singular="Role"
    max="8"
    error-key="items"
    :items="$items"
    :fallback="['title' => '', 'team' => '', 'type' => '', 'location' => '', 'body' => '']"
>
    <div class="mb-3">
        <label class="form-label" :for="`role-title-${index}`">Title</label>
        <input :id="`role-title-${index}`" :name="`items[${index}][title]`" x-model="item.title" class="form-control">
    </div>
    <div class="row">
        <div class="col-4">
            <label class="form-label" :for="`role-team-${index}`">Team</label>
            <input :id="`role-team-${index}`" :name="`items[${index}][team]`" x-model="item.team" class="form-control">
        </div>
        <div class="col-4">
            <label class="form-label" :for="`role-type-${index}`">Type</label>
            <input :id="`role-type-${index}`" :name="`items[${index}][type]`" x-model="item.type" class="form-control" placeholder="Full-time">
        </div>
        <div class="col-4">
            <label class="form-label" :for="`role-location-${index}`">Location</label>
            <input :id="`role-location-${index}`" :name="`items[${index}][location]`" x-model="item.location" class="form-control">
        </div>
    </div>
    <div class="mt-3 mb-0">
        <label class="form-label" :for="`role-body-${index}`">Summary</label>
        <textarea :id="`role-body-${index}`" :name="`items[${index}][body]`" x-model="item.body" class="form-control" rows="3" placeholder="One-sentence summary of the role"></textarea>
    </div>
</x-admin.repeatable-list>
