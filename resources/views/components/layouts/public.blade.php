@props([
    'title' => null,
    'description' => null,
    'hideHeader' => false,
    'bodyClass' => '',
    'homePage' => false,
    'recruitPage' => false,
])

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
    @if (filled($description))
        <meta name="description" content="{{ $description }}">
    @endif
    @if ($homePage || $recruitPage)
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;1,9..144,400&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    @endif
    @if ($homePage)
        <link rel="stylesheet" href="{{ asset('css/frontend/home.css') }}">
    @elseif ($recruitPage)
        <link rel="stylesheet" href="{{ asset('css/frontend/recruit.css') }}">
    @else
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/frontend/base.css') }}">
        <link rel="stylesheet" href="{{ asset('css/frontend/layout.css') }}">
        <link rel="stylesheet" href="{{ asset('css/frontend/buttons.css') }}">
    @endif
</head>
<body @class([$bodyClass => filled($bodyClass)])>
    @unless ($hideHeader)
        <header class="site-header">
            <a class="brand" href="{{ route('home') }}">{{ config('app.name', 'Laravel') }}</a>
            <nav class="nav-links" aria-label="Primary">
                @auth
                    <a href="{{ route('admin.dashboard') }}">Admin</a>
                @else
                    <a href="{{ route('admin.login') }}">Log in</a>
                    <a class="button button-small" href="{{ route('admin.register') }}">Create account</a>
                @endauth
            </nav>
        </header>
    @endunless

    <main>
        {{ $slot }}
    </main>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"></script>
    @if ($homePage || $recruitPage)
        <script src="{{ asset('js/marketing.js') }}"></script>
    @else
        <script src="{{ asset('js/site.js') }}"></script>
    @endif
</body>
</html>
