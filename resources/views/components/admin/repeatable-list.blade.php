@props([
    'title',
    'items' => [],
    'fallback' => [],
    'addLabel' => 'Add',
    'singular' => 'Item',
    'max' => null,
    'columns' => '1',
    'errorKey' => null,
])

@php
    use Illuminate\Support\Js;

    $columnClass = [
        '1' => 'col-12',
        '2' => 'col-md-6',
        '3' => 'col-md-4',
    ][$columns] ?? 'col-12';

    $itemsJson = Js::from($items);
    $fallbackJson = Js::from($fallback);
    $maxGuard = $max ? "this.items.length >= {$max}" : 'false';
@endphp

<div
    {{ $attributes->class(['repeatable-list']) }}
    x-data="{
        items: repeatableListItems({{ $itemsJson }}, {{ $fallbackJson }}),
        add() {
            if ({{ $maxGuard }}) return;

            this.items.push(repeatableListItem({{ $fallbackJson }}));
        },
        remove(index) {
            if (this.items.length > 1) this.items.splice(index, 1);
        },
        move(index, direction) {
            const nextIndex = index + direction;

            if (nextIndex < 0 || nextIndex >= this.items.length) return;

            [this.items[index], this.items[nextIndex]] = [this.items[nextIndex], this.items[index]];
        },
    }"
>
    <x-admin.card :title="$title">
        <x-slot:headerActions>
            <button class="btn btn-sm" type="button" x-on:click="add()" @if ($max) :disabled="items.length >= {{ $max }}" @endif>
                <i class="ti ti-plus icon" aria-hidden="true"></i>
                {{ $addLabel }}
            </button>
        </x-slot:headerActions>

        <div class="card-body">
            <div class="{{ $columns === '1' ? '' : 'row row-cards' }}">
                <template x-for="(item, index) in items" :key="item.id">
                    <div class="{{ $columnClass }}">
                        <div class="border rounded p-3 h-100 {{ $columns === '1' ? 'mb-3' : '' }}">
                            <div class="d-flex justify-content-between gap-2 mb-3">
                                <strong x-text="`{{ $singular }} ${index + 1}`"></strong>
                                <div class="btn-list flex-nowrap repeatable-list__actions">
                                    <button
                                        class="btn btn-sm btn-outline-secondary btn-icon"
                                        type="button"
                                        x-on:click="move(index, -1)"
                                        :disabled="index === 0"
                                        title="Move up"
                                        aria-label="Move up"
                                    >
                                        <i class="ti ti-arrow-up icon" aria-hidden="true"></i>
                                    </button>
                                    <button
                                        class="btn btn-sm btn-outline-secondary btn-icon"
                                        type="button"
                                        x-on:click="move(index, 1)"
                                        :disabled="index === items.length - 1"
                                        title="Move down"
                                        aria-label="Move down"
                                    >
                                        <i class="ti ti-arrow-down icon" aria-hidden="true"></i>
                                    </button>
                                    <button
                                        class="btn btn-sm btn-outline-danger btn-icon"
                                        type="button"
                                        x-on:click="remove(index)"
                                        :disabled="items.length === 1"
                                        title="Remove"
                                        aria-label="Remove"
                                    >
                                        <i class="ti ti-trash icon" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>

                            {{ $slot }}
                        </div>
                    </div>
                </template>
            </div>

            @if ($errorKey)
                @error($errorKey)
                    <div class="text-danger small mt-2">{{ $message }}</div>
                @enderror
            @endif
        </div>
    </x-admin.card>
</div>