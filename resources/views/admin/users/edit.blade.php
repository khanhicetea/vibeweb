<x-layouts.admin title="Edit User" heading="Edit User">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <x-admin.card :title="$user->name">
                <form method="POST" action="{{ route('admin.users.update', $user) }}">
                    @csrf
                    @method('PUT')
                    @include('admin.users.partials.form', ['user' => $user])
                </form>
            </x-admin.card>
        </div>
    </div>
</x-layouts.admin>
