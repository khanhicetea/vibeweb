<x-layouts.admin title="Users" heading="Users">
    <x-admin.card title="Manage Users">
        <x-slot:headerActions>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">New user</a>
        </x-slot:headerActions>

        <div class="table-responsive">
            <table class="table table-vcenter card-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created</th>
                        <th class="w-1"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="fw-semibold">{{ $user->name }}</td>
                            <td class="text-secondary">{{ $user->email }}</td>
                            <td class="text-secondary">{{ $user->created_at->format('M j, Y') }}</td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm">Edit</a>
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" type="submit" @disabled(auth()->id() === $user->id)>Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-secondary py-5">No users yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($users->hasPages())
            <div class="card-footer">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </x-admin.card>
</x-layouts.admin>
