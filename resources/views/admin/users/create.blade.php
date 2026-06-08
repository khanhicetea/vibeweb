<x-layouts.admin title="New User" heading="New User">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <x-admin.card title="Create User">
                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf
                    @include('admin.users.partials.form', ['user' => null])
                </form>
            </x-admin.card>
        </div>
    </div>
</x-layouts.admin>
