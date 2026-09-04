@props([
    'links' => [],
])

<footer class="site-footer">
    <div class="container footer-inner">
        <div class="footer-brand">
            <span class="brand-mark" aria-hidden="true">N</span>
            <div>
                <strong>Northline Marketing</strong>
                <span>Strategy &amp; growth consulting</span>
            </div>
        </div>
        <nav class="footer-nav" aria-label="Footer">
            @foreach ($links as $link)
                <a href="{{ data_get($link, 'href') }}">{{ data_get($link, 'label') }}</a>
            @endforeach
        </nav>
        <p class="footer-copy">&copy; {{ date('Y') }} Northline Marketing. All rights reserved.</p>
    </div>
</footer>
