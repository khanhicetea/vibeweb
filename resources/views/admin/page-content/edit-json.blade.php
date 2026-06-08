<x-layouts.admin title="Edit PageContent" heading="Edit PageContent">
    <form method="POST" action="{{ route('admin.page-content.update', $pageContent) }}">
        @csrf
        @method('PUT')

        <x-admin.card :title="$pageContent->displayName()">
            <div class="card-body">
                <x-admin.field label="Description" name="description" for="description">
                    <x-admin.textarea
                        id="description"
                        name="description"
                        rows="2"
                        :value="old('description', $pageContent->description)"
                    />
                </x-admin.field>

                <x-admin.field label="JSON value" name="json" for="json">
                    <x-admin.textarea
                        id="json"
                        name="json"
                        class="font-monospace"
                        rows="18"
                        :value="old('json', $json)"
                    />
                </x-admin.field>
            </div>

            <x-slot:footerActions>
                <button class="btn btn-primary" type="submit">Save content</button>
                <a href="{{ route('admin.page-content.index') }}" class="btn">Back</a>
            </x-slot:footerActions>
        </x-admin.card>
    </form>
</x-layouts.admin>
