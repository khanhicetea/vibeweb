<x-layouts.public
    title="Careers at Northline Marketing — Join the team"
    description="Northline is hiring in Chicago and across the US. See open roles in growth, content, and analytics — and how our hiring process works."
    hide-header
    body-class="marketing-page"
    marketing
    :styles="['css/frontend/recruit.css']"
>
    @php
        $roles = data_get($collections, 'roles', []);
        $applyEmail = 'hello@northline.marketing';
    @endphp

    <a class="skip-link" href="#main-content">Skip to content</a>

    <div class="page-grain" aria-hidden="true"></div>

    <header class="site-header">
        <div class="site-header-inner">
            <a class="brand" href="{{ route('home') }}">
                <span class="brand-mark" aria-hidden="true">N</span>
                Northline
            </a>
            <nav class="site-nav" id="siteNav" aria-label="Primary">
                <a href="#why" data-section="why">Why Northline</a>
                <a href="#roles" data-section="roles">Open roles</a>
                <a href="#process" data-section="process">Hiring process</a>
            </nav>
            <div class="header-actions">
                <button class="nav-toggle" id="navToggle" type="button" aria-label="Open menu" aria-expanded="false">
                    <span></span><span></span><span></span>
                </button>
                <a class="btn btn-primary" href="#roles">See open roles</a>
            </div>
        </div>
    </header>

    <section id="main-content" class="hero">
        <div class="hero-grid">
            <div class="hero-copy">
                <p class="eyebrow rv">Careers at Northline</p>
                <h1 class="hero-title rv d1">
                    Practical people.
                    <em>Real ownership.</em>
                </h1>
                <p class="hero-lead rv d2">
                    We're a twelve-person consultancy hiring curious operators who like owning engagements end to end.
                </p>
                <div class="hero-actions rv d2">
                    <a class="btn btn-primary" href="#roles">See open roles</a>
                    <a class="btn btn-text" href="mailto:{{ $applyEmail }}">Say hello</a>
                </div>
            </div>
            <aside class="hero-side rv d2" aria-label="Northline at a glance">
                <figure class="hero-photo">
                    <img
                        src="https://picsum.photos/seed/northline-studio/960/720"
                        alt="The Northline team working together in the Chicago studio"
                        width="960"
                        height="720"
                        loading="eager"
                        decoding="async"
                    >
                </figure>
                <div class="hero-facts">
                    <div>
                        <span class="fact-value">12</span>
                        <span class="fact-label">People, no account layers</span>
                    </div>
                    <div>
                        <span class="fact-value">2019</span>
                        <span class="fact-label">Founded in Chicago</span>
                    </div>
                    <div>
                        <span class="fact-value">{{ count($roles) }}</span>
                        <span class="fact-label">Open roles right now</span>
                    </div>
                </div>
            </aside>
        </div>
    </section>

    <section id="why" class="section section-muted" data-section="why">
        <div class="container benefits-layout">
            <div class="section-head rv">
                <h2>Why people stay.</h2>
                <p class="section-lead">Five reasons consultants join Northline — and the reasons they're still here.</p>
            </div>
            <ul class="benefit-list">
                @foreach (data_get($collections, 'benefits', []) as $index => $benefit)
                    <li class="benefit-row rv @if ($index > 0) d{{ min($index, 2) }} @endif">
                        <h3>{{ data_get($benefit, 'title') }}</h3>
                        <x-frontend.markdown-text :text="data_get($benefit, 'body')" :inline="false" class="benefit-body" />
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <section id="roles" class="section" data-section="roles">
        <div class="container">
            <div class="section-head rv">
                <h2>Open roles.</h2>
                <p class="section-lead">Where we need help right now. Every role is Chicago-based or remote within the US.</p>
            </div>
            <div class="role-list">
                @forelse ($roles as $role)
                    <article class="role-row rv">
                        <div class="role-info">
                            <h3>{{ data_get($role, 'title') }}</h3>
                            <p class="role-meta">
                                @if (filled(data_get($role, 'type')))
                                    <span class="role-chip">{{ data_get($role, 'type') }}</span>
                                @endif
                                @if (filled(data_get($role, 'location')))
                                    <span class="role-chip">{{ data_get($role, 'location') }}</span>
                                @endif
                            </p>
                            <p class="role-summary">{{ data_get($role, 'summary') }}</p>
                        </div>
                        <a
                            class="btn btn-ghost role-apply"
                            href="mailto:{{ $applyEmail }}?subject={{ rawurlencode('Application — '.data_get($role, 'title')) }}"
                        >Apply</a>
                    </article>
                @empty
                    <p class="roles-footnote">No open roles right now — check back soon.</p>
                @endforelse
            </div>
            @if (count($roles) > 0)
                <p class="roles-footnote rv">
                    Nothing that fits?
                    <a href="mailto:{{ $applyEmail }}?subject={{ rawurlencode('Say hello') }}">Say hello</a> — we hire ahead of growth.
                </p>
            @endif
        </div>
    </section>

    <section id="process" class="section section-muted" data-section="process">
        <div class="container">
            <div class="section-head process-head rv">
                <h2>How hiring works.</h2>
                <p class="section-lead">Four steps, about three weeks, no interview loops that go nowhere.</p>
            </div>
            <ol class="process-track">
                @foreach (data_get($collections, 'process', []) as $index => $step)
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
    </section>

    <section id="voices" class="section">
        <div class="container">
            <div class="section-head rv">
                <h2>In their words.</h2>
                <p class="section-lead">Teammates on what the job is actually like.</p>
            </div>
            <div class="voice-grid">
                @foreach (data_get($collections, 'testimonials', []) as $index => $testimonial)
                    <blockquote class="voice rv @if ($index === 0) voice--featured @endif @if ($index > 0) d{{ min($index, 1) }} @endif">
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

    <section class="section section-cta">
        <div class="container">
            <div class="join-card rv">
                <div class="join-copy">
                    <h2>Nothing that fits?</h2>
                    <p class="section-lead">We hire ahead of growth and keep a short list of people we call first. Send a note about the work you want to do.</p>
                </div>
                <div class="join-actions">
                    <a class="btn btn-primary" href="mailto:{{ $applyEmail }}?subject={{ rawurlencode('Say hello') }}">Say hello</a>
                    <span class="join-note">Every note gets a reply within a week.</span>
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
                <a href="{{ route('home') }}#services">Services</a>
                <a href="{{ route('home') }}#contact">Contact</a>
                <a href="{{ route('recruit') }}">Careers</a>
            </nav>
            <p class="footer-copy">© {{ date('Y') }} Northline Marketing. All rights reserved.</p>
        </div>
    </footer>
</x-layouts.public>
