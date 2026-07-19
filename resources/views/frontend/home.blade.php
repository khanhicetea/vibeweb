<x-layouts.public
    title="Northline Marketing — Strategy & Growth Consulting"
    description="Northline helps founders and marketing teams sharpen positioning, build campaigns that convert, and measure what moves revenue."
    hide-header
    body-class="home-page"
    home-page
>
    <a class="skip-link" href="#main-content">Skip to content</a>

    <div class="page-grain" aria-hidden="true"></div>

    <header class="site-header">
        <div class="site-header-inner">
            <a class="brand" href="{{ route('home') }}">
                <span class="brand-mark" aria-hidden="true">N</span>
                Northline
            </a>
            <nav class="site-nav" id="siteNav" aria-label="Primary">
                <a href="#services" data-section="services">Services</a>
                <a href="#approach" data-section="approach">Approach</a>
                <a href="#results" data-section="results">Results</a>
                <a href="#contact" data-section="contact">Contact</a>
            </nav>
            <div class="header-actions">
                <button class="nav-toggle" id="navToggle" type="button" aria-label="Open menu" aria-expanded="false">
                    <span></span><span></span><span></span>
                </button>
                <a class="btn btn-primary" href="#contact">Book a call</a>
            </div>
        </div>
    </header>

    <section id="main-content" class="hero">
        <div class="hero-backdrop" aria-hidden="true">
            <img
                src="https://picsum.photos/seed/northline-hero/1920/1080"
                alt=""
                width="1920"
                height="1080"
                loading="eager"
                decoding="async"
            >
        </div>
        <div class="hero-grid">
            <div class="hero-copy">
                <p class="eyebrow rv">Digital Marketing consulting</p>
                <h1 class="hero-title rv d1">
                    Clarity for brands
                    <em>ready to grow.</em>
                </h1>
                <p class="hero-lead rv d2">
                    Northline helps founders and marketing teams sharpen positioning, build campaigns that convert, and measure what actually moves revenue.
                </p>
                <div class="hero-actions rv d2">
                    <a class="btn btn-primary" href="#contact">Start a project</a>
                    <a class="btn btn-text" href="#services">View services</a>
                </div>
                <ul class="hero-points rv d3">
                    @foreach (data_get($collections, 'hero_points', []) as $point)
                        <li>{{ is_array($point) ? ($point['value'] ?? '') : $point }}</li>
                    @endforeach
                </ul>
            </div>
            <aside class="hero-panel rv d2" aria-label="Current engagement snapshot">
                <div class="hero-panel-card">
                    <span class="panel-label">Current focus</span>
                    <strong>Go-to-market for B2B SaaS</strong>
                    <p>Launch narrative, paid acquisition, and sales enablement in one coordinated sprint.</p>
                </div>
                <div class="hero-panel-stats">
                    @foreach (data_get($collections, 'hero_stats', []) as $stat)
                        <div>
                            <span class="stat-value">{{ data_get($stat, 'value') }}</span>
                            <span class="stat-label">{{ data_get($stat, 'label') }}</span>
                        </div>
                    @endforeach
                </div>
            </aside>
        </div>
    </section>

    <section id="services" class="section" data-section="services">
        <div class="container">
            <div class="section-head section-head--offset rv">
                <p class="eyebrow">Services</p>
                <h2>Practical marketing leadership, without the overhead.</h2>
                <p class="section-lead">Engagements are scoped around outcomes — not decks. Pick a focused sprint or ongoing advisory.</p>
            </div>
            <div class="service-grid">
                @foreach (data_get($collections, 'services', []) as $index => $service)
                    <article class="service-card rv @if ($index === 0) service-card--featured @endif @if ($index > 0) d{{ min($index, 3) }} @endif">
                        <span class="service-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <h3>{{ data_get($service, 'title') }}</h3>
                        <x-frontend.markdown-text :text="data_get($service, 'body')" :inline="false" class="service-body" />
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="approach" class="section section-muted" data-section="approach">
        <div class="container">
            <div class="approach-layout">
                <div class="section-head rv">
                    <p class="eyebrow">Approach</p>
                    <h2>Simple process. Sharp execution.</h2>
                    <p class="section-lead">Three phases, one thread — diagnose the gap, design the plan, deliver with your team in the room.</p>
                </div>
                <ol class="process-track">
                    @foreach (data_get($collections, 'steps', []) as $index => $step)
                        <li class="process-step rv @if ($index > 0) d{{ min($index, 2) }} @endif">
                            <span class="process-index">{{ $loop->iteration }}</span>
                            <div class="process-content">
                                <h3>{{ data_get($step, 'title') }}</h3>
                                <x-frontend.markdown-text :text="data_get($step, 'body')" :inline="false" class="process-body" />
                            </div>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </section>

    <section id="results" class="section" data-section="results">
        <div class="container">
            <div class="results-intro rv">
                <p class="eyebrow">Results</p>
                <h2>Outcomes clients measure, not vanity metrics.</h2>
                <p class="section-lead">Recent engagements across SaaS, professional services, and consumer brands.</p>
            </div>
            <div class="results-strip rv d1">
                @foreach (data_get($collections, 'stats', []) as $stat)
                    <div class="result-card">
                        <span class="result-value">{{ data_get($stat, 'value') }}</span>
                        <span class="result-label">{{ data_get($stat, 'label') }}</span>
                    </div>
                @endforeach
            </div>
            <div class="testimonial-stack">
                @foreach (data_get($collections, 'testimonials', []) as $index => $testimonial)
                    <blockquote class="testimonial rv @if ($index === 0) testimonial--featured @endif @if ($index > 0) d{{ min($index, 1) }} @endif">
                        <p>"{{ data_get($testimonial, 'quote') }}"</p>
                        <footer>
                            <strong>{{ data_get($testimonial, 'name') }}</strong>
                            <span>{{ data_get($testimonial, 'role') }}</span>
                        </footer>
                    </blockquote>
                @endforeach
            </div>
        </div>
    </section>

    <section id="contact" class="section section-cta" data-section="contact">
        <div class="container">
            <div class="cta-card rv">
                <div class="cta-copy">
                    <p class="eyebrow">Contact</p>
                    <h2>Let's talk about your next growth chapter.</h2>
                    <p class="section-lead">Share where you are today and where you want to be. You'll get a concise recommendation within two business days.</p>
                </div>
                <div class="cta-actions">
                    <a class="btn btn-primary" href="mailto:hello@northline.marketing">hello@northline.marketing</a>
                    <a class="btn btn-ghost" href="tel:+13128471928">+1 (312) 847-1928</a>
                </div>
            </div>
        </div>
    </section>

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
                <a href="#services">Services</a>
                <a href="#contact">Contact</a>
            </nav>
            <p class="footer-copy">© {{ date('Y') }} Northline Marketing. All rights reserved.</p>
        </div>
    </footer>
</x-layouts.public>