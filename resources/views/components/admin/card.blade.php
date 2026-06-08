@props([
    'title' => null,
    'footer' => null,
])

<div {{ $attributes->class(['card']) }}>
    @if ($title || isset($header) || isset($headerActions))
        <div class="card-header">
            @if (isset($header))
                {{ $header }}
            @elseif ($title)
                <h3 class="card-title">{{ $title }}</h3>
            @endif

            @isset($headerActions)
                <div class="card-actions">
                    {{ $headerActions }}
                </div>
            @endisset
        </div>
    @endif

    {{ $slot }}

    @if ($footer || isset($footerActions))
        <div class="card-footer {{ isset($footerActions) ? 'd-flex justify-content-between align-items-center gap-2' : '' }}">
            @if ($footer)
                <div>{{ $footer }}</div>
            @endif

            @isset($footerActions)
                <div class="btn-list ms-auto">
                    {{ $footerActions }}
                </div>
            @endisset
        </div>
    @endif
</div>
