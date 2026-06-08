<div class="card-body">
    <x-admin.field label="Name" name="name" for="name">
        <x-admin.input
            id="name"
            name="name"
            :value="old('name', $user?->name)"
            required
        />
    </x-admin.field>

    <x-admin.field label="Email" name="email" for="email">
        <x-admin.input
            id="email"
            name="email"
            type="email"
            :value="old('email', $user?->email)"
            required
        />
    </x-admin.field>

    <x-admin.field
        label="Password"
        name="password"
        for="password"
        :hint="$user ? 'Leave blank to keep the current password.' : null"
    >
        <x-admin.input
            id="password"
            name="password"
            type="password"
            {{ $user ? '' : 'required' }}
        />
    </x-admin.field>

    <x-admin.field label="Confirm password" name="password_confirmation" for="password_confirmation">
        <x-admin.input
            id="password_confirmation"
            name="password_confirmation"
            type="password"
            {{ $user ? '' : 'required' }}
        />
    </x-admin.field>
</div>

<div class="card-footer text-end">
    <a href="{{ route('admin.users.index') }}" class="btn">Cancel</a>
    <button class="btn btn-primary" type="submit">{{ $user ? 'Save changes' : 'Create user' }}</button>
</div>
