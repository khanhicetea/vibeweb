<x-layouts.admin title="PageContent" heading="PageContent Collections">
    @forelse ($groups as $page => $collections)
        <x-admin.card :title="str($page)->headline()" :class="!$loop->first ? 'mt-3' : ''">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>Collection</th>
                            <th>Description</th>
                            <th>Updated</th>
                            <th class="w-1">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($collections as $collection)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ str($collection->collectionName())->headline() }}</div>
                                    <div class="text-secondary"><code>{{ $collection->key }}</code></div>
                                </td>
                                <td class="text-secondary">{{ $collection->description }}</td>
                                <td class="text-secondary text-nowrap">{{ $collection->updated_at?->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('admin.page-content.edit', $collection) }}" class="btn btn-sm">
                                        <i class="ti ti-edit icon" aria-hidden="true"></i>
                                        Editor
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-admin.card>
    @empty
        <x-admin.card>
            <x-admin.empty-state
                icon="ti-file-pencil"
                title="No collections yet"
                body="Seed or create PageContent collection records to edit repeatable page data here."
            />
        </x-admin.card>
    @endforelse
</x-layouts.admin>