<x-admin.repeatable-list
    title="Steps"
    add-label="Add step"
    singular="Step"
    max="8"
    error-key="items"
    :items="$items"
    :fallback="['title' => '', 'body' => '']"
>
    <label class="form-label" :for="`step-title-${index}`">Title</label>
    <input :id="`step-title-${index}`" :name="`items[${index}][title]`" x-model="item.title" class="form-control mb-2">
    <label class="form-label" :for="`step-body-${index}`">Body</label>
    <textarea :id="`step-body-${index}`" :name="`items[${index}][body]`" x-model="item.body" class="form-control" rows="3" placeholder="Supports markdown"></textarea>
</x-admin.repeatable-list>