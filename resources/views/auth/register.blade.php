<x-layouts.auth title="Sign up">
    <form class="card card-md" method="POST" action="{{ route('admin.register') }}" autocomplete="off">
        @csrf

        <div class="card-body">
            <h2 class="card-title text-center mb-4">Create new account</h2>

            <div class="mb-3">
                <label class="form-label" for="name">Name</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
                    placeholder="Enter name"
                    autocomplete="name"
                    required
                    autofocus
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="email">Email address</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}"
                    placeholder="Enter email"
                    autocomplete="email"
                    required
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-flat">
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Password"
                        autocomplete="new-password"
                        required
                    >
                    <span class="input-group-text">
                        <a href="#" class="link-secondary" title="Show password" data-toggle-password>
                            <i class="ti ti-eye icon" aria-hidden="true"></i>
                        </a>
                    </span>
                </div>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="password_confirmation">Confirm password</label>
                <div class="input-group input-group-flat">
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        class="form-control"
                        placeholder="Confirm password"
                        autocomplete="new-password"
                        required
                    >
                    <span class="input-group-text">
                        <a href="#" class="link-secondary" title="Show password" data-toggle-password>
                            <i class="ti ti-eye icon" aria-hidden="true"></i>
                        </a>
                    </span>
                </div>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">Create new account</button>
            </div>
        </div>
    </form>

    <div class="text-center text-secondary mt-3">
        Already have account? <a href="{{ route('admin.login') }}" tabindex="-1">Sign in</a>
    </div>
</x-layouts.auth>