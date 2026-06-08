<x-layouts.admin :title="'Edit '.$pageContent->displayName()" :heading="$pageContent->displayName()">
    <form method="POST" action="{{ route('admin.page-content.update', $pageContent) }}">
        @csrf
        @method('PUT')

        <div class="row row-cards">
            <div class="col-lg-8">
                @include('admin.page-content.schemas.'.$schema, ['items' => $items])
            </div>

            <div class="col-lg-4">
                <x-admin.page-content.page-record :page-content="$pageContent">
                    <x-slot:headerActions>
                        <button class="btn btn-primary btn-sm" type="submit">Save collection</button>
                    </x-slot:headerActions>
                </x-admin.page-content.page-record>
            </div>
        </div>
    </form>
</x-layouts.admin>