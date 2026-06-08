<x-admin.repeatable-list
    title="Testimonials"
    add-label="Add testimonial"
    singular="Testimonial"
    columns="2"
    max="8"
    error-key="items"
    :items="$items"
    :fallback="['quote' => '', 'name' => '', 'role' => '']"
>
    <div class="mb-3">
        <label class="form-label" :for="`testimonial-quote-${index}`">Quote</label>
        <textarea :id="`testimonial-quote-${index}`" :name="`items[${index}][quote]`" x-model="item.quote" class="form-control" rows="4"></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label" :for="`testimonial-name-${index}`">Name</label>
        <input :id="`testimonial-name-${index}`" :name="`items[${index}][name]`" x-model="item.name" class="form-control">
    </div>
    <div class="mb-0">
        <label class="form-label" :for="`testimonial-role-${index}`">Role</label>
        <input :id="`testimonial-role-${index}`" :name="`items[${index}][role]`" x-model="item.role" class="form-control">
    </div>
</x-admin.repeatable-list>