<x-admin.repeatable-list
    title="Services"
    add-label="Add service"
    singular="Service"
    columns="2"
    max="8"
    error-key="items"
    :items="$items"
    :fallback="['title' => '', 'body' => '']"
>
    <div class="mb-3">
        <label class="form-label" :for="`service-title-${index}`">Title</label>
        <input :id="`service-title-${index}`" :name="`items[${index}][title]`" x-model="item.title" class="form-control">
    </div>
    <div class="mb-0">
        <label class="form-label" :for="`service-body-${index}`">Summary &amp; bullets</label>
        <textarea :id="`service-body-${index}`" :name="`items[${index}][body]`" x-model="item.body" class="form-control" rows="5" placeholder="Summary paragraph, then markdown bullets"></textarea>
    </div>
</x-admin.repeatable-list>