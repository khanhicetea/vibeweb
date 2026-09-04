<x-layouts.public
    title="Careers at Northline Marketing"
    description="Northline is a 14-person strategy consultancy in Chicago. See open roles in strategy, campaigns, and analytics, and how we hire."
    hide-header
    body-class="recruit-page"
    recruit-page
>
    <a class="skip-link" href="#main-content">Skip to content</a>

    <div class="page-grain" aria-hidden="true"></div>

    <x-frontend.site-header
        :nav="[
            ['label' => 'Why Northline', 'href' => '#values', 'section' => 'values'],
            ['label' => 'Open roles', 'href' => '#roles', 'section' => 'roles'],
            ['label' => 'How we hire', 'href' => '#process', 'section' => 'process'],
        ]"
        cta-label="Apply now"
        cta-href="mailto:hello@northline.marketing?subject={{ rawurlencode('Application') }}"
    />

    <section id="main-content" class="hero">
        <div class="hero-backdrop" aria-hidden="true">
            <img
                src="https://picsum.photos/seed/northline-studio-team/1920/1080"
                alt=""
                width="1920"
                height="1080"
                loading="eager"
                decoding="async"
            >
        </div>
        <div class="hero-grid">
            <div class="hero-copy">
                <p class="eyebrow rv">Careers at Northline</p>
                <h1 class="hero-title rv d1">
                    Do the best work of your career
                    <em>in a small room.</em>
                </h1>
                <p class="hero-lead rv d2">
                    Northline is a 14-person consultancy in Chicago. We hire senior thinkers who would rather ship the plan than present it.
                </p>
                <div class="hero-actions rv d2">
                    <a class="btn btn-primary" href="mailto:hello@northline.marketing?subject={{ rawurlencode('Application') }}">Apply now</a>
                    <a class="btn btn-text" href="#roles">View open roles</a>
                </div>
            </div>
            <aside class="hero-panel rv d2" aria-label="Life at Northline snapshot">
                <div class="hero-panel-card">
                    <span class="panel-label">Life at Northline</span>
                    <strong>Hybrid, Chicago HQ</strong>
                    <p>Two days in the studio, three wherever you think best. Fridays are for learning, not timesheets.</p>
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

    <section id="values" class="section" data-section="values">
        <div class="container">
            <div class="section-head section-head--offset rv">
                <h2>Why people join, and why they stay.</h2>
                <p class="section-lead">No pyramids, no pitch theater. Small senior teams, short feedback loops, and work you can point at.</p>
            </div>
            <div class="value-grid">
                @foreach (data_get($collections, 'values', []) as $index => $value)
                    <article class="value-card rv @if ($index > 0) d{{ min($index, 3) }} @endif">
                        <h3>{{ data_get($value, 'title') }}</h3>
                        <x-frontend.markdown-text :text="data_get($value, 'body')" :inline="false" class="value-body" />
                    </article>
                @endforeach
            </div>
            <div class="perks-strip rv">
                <span class="perks-label">And the practical stuff</span>
                @foreach (data_get($collections, 'perks', []) as $perk)
                    <span class="perk-pill">{{ is_array($perk) ? ($perk['value'] ?? '') : $perk }}</span>
                @endforeach
            </div>
        </div>
    </section>

    <section id="roles" class="section section-muted" data-section="roles">
        <div class="container">
            <div class="results-intro rv">
                <h2>Open roles</h2>
                <p class="section-lead">Every role owns real client work from week one. Don't see your fit? Apply anyway and tell us what you would bring.</p>
            </div>
            <div class="roles-list rv d1">
                @foreach (data_get($collections, 'roles', []) as $role)
                    <a
                        class="role-row"
                        href="mailto:hello@northline.marketing?subject={{ rawurlencode('Application: '.data_get($role, 'title')) }}"
                    >
                        <div class="role-main">
                            <h3>{{ data_get($role, 'title') }}</h3>
                            <p class="role-meta">
                                @if (filled(data_get($role, 'team'))) <span>{{ data_get($role, 'team') }}</span> @endif
                                @if (filled(data_get($role, 'type'))) <span>{{ data_get($role, 'type') }}</span> @endif
                                @if (filled(data_get($role, 'location'))) <span>{{ data_get($role, 'location') }}</span> @endif
                            </p>
                        </div>
                        <p class="role-body">{{ data_get($role, 'body') }}</p>
                        <span class="role-apply">Apply now</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section id="process" class="section" data-section="process">
        <div class="container">
            <div class="approach-layout">
                <div class="section-head rv">
                    <h2>How we hire</h2>
                    <p class="section-lead">Four steps, about two weeks, and one honest conversation at every stage.</p>
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

    <section id="apply" class="section section-cta">
        <div class="container">
            <div class="cta-card rv">
                <div class="cta-copy">
                    <h2>Ready when you are.</h2>
                    <p class="section-lead">Send a note about the work you want to do. We read every application and reply within a week.</p>
                </div>
                <div class="cta-actions">
                    <a class="btn btn-primary" href="mailto:hello@northline.marketing?subject={{ rawurlencode('Application') }}">Apply now</a>
                    <a class="btn btn-ghost" href="#roles">View open roles</a>
                </div>
            </div>
        </div>
    </section>

    <x-frontend.site-footer
        :links="[
            ['label' => 'Home', 'href' => route('home')],
            ['label' => 'Open roles', 'href' => '#roles'],
            ['label' => 'Apply', 'href' => '#apply'],
        ]"
    />
</x-layouts.public>
