<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin' }} - {{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/backend/admin.css') }}">
</head>
<body>
    <div class="page">
        <header class="navbar navbar-expand-md d-print-none">
            <div class="container-xl">
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <div class="navbar-nav flex-row order-md-last">
                    <div class="nav-item me-3">
                        <a class="nav-link px-0" href="{{ route('home') }}" aria-label="Open public site" title="Open public site">
                            <i class="ti ti-world-www icon" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                            <span class="avatar avatar-sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                            <div class="d-none d-xl-block ps-2">
                                <div>{{ auth()->user()->name }}</div>
                                <div class="mt-1 small text-secondary">{{ auth()->user()->email }}</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a class="dropdown-item" href="{{ route('home') }}">Public homepage</a>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">Log out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <header class="navbar-expand-md">
            <div class="collapse navbar-collapse show">
                <div class="navbar">
                    <div class="container-xl">
                        <ul class="navbar-nav">
                            <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-home icon" aria-hidden="true"></i>
                                    </span>
                                    <span class="nav-link-title">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('admin.page-content.*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.page-content.index') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-file-pencil icon" aria-hidden="true"></i>
                                    </span>
                                    <span class="nav-link-title">PageContent</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown {{ request()->routeIs('admin.users.*') || request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="#navbar-settings" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-settings icon" aria-hidden="true"></i>
                                    </span>
                                    <span class="nav-link-title">Settings</span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                                        Users
                                    </a>
                                    <a class="dropdown-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.edit') }}">
                                        Website Settings
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <div class="page-wrapper">
            <div class="page-body">
                <div class="container-xl">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/js/tabler.min.js"></script>
    <script>
        function repeatableListItem(fallback) {
            return {
                id: crypto.randomUUID(),
                ...fallback,
            };
        }

        function repeatableListItems(items, fallback) {
            const source = Array.isArray(items) && items.length ? items : [fallback];

            return source.map((item) => ({
                ...repeatableListItem(fallback),
                ...item,
            }));
        }
    </script>
    <script src="{{ asset('js/admin-image-input.js') }}"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
