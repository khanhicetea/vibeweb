<x-layouts.auth title="Sign in">
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Login to your account</h2>

            <form method="POST" action="{{ route('admin.login') }}" autocomplete="off">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="email">Email address</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        placeholder="your@email.com"
                        autocomplete="email"
                        required
                        autofocus
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group input-group-flat">
                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Your password"
                            autocomplete="current-password"
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

                <div class="mb-2">
                    <label class="form-check">
                        <input name="remember" type="checkbox" class="form-check-input" value="1" @checked(old('remember'))>
                        <span class="form-check-label">Remember me on this device</span>
                    </label>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Sign in</button>
                </div>
            </form>
        </div>
    </div>

    <div class="text-center text-secondary mt-3">
        Don't have account yet? <a href="{{ route('admin.register') }}" tabindex="-1">Sign up</a>
    </div>
</x-layouts.auth>