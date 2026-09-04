@props([
    'nav' => [],
    'ctaLabel' => 'Get in touch',
    'ctaHref' => '#contact',
])

<header class="site-header">
    <div class="site-header-inner">
        <a class="brand" href="{{ route('home') }}">
            <span class="brand-mark" aria-hidden="true">N</span>
            Northline
        </a>
        <nav class="site-nav" id="siteNav" aria-label="Primary">
            @foreach ($nav as $link)
                <a href="{{ data_get($link, 'href') }}" @if (filled(data_get($link, 'section'))) data-section="{{ data_get($link, 'section') }}" @endif>{{ data_get($link, 'label') }}</a>
            @endforeach
        </nav>
        <div class="header-actions">
            <button class="nav-toggle" id="navToggle" type="button" aria-label="Open menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
            <a class="btn btn-primary" href="{{ $ctaHref }}">{{ $ctaLabel }}</a>
        </div>
    </div>
</header>
