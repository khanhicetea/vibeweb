@props([
    'icon' => 'ti-inbox',
    'title' => 'Nothing here yet',
    'body' => null,
])

<div {{ $attributes->class(['empty']) }}>
    <div class="empty-icon">
        <i class="ti {{ $icon }}" aria-hidden="true"></i>
    </div>
    <p class="empty-title">{{ $title }}</p>
    @if ($body)
        <p class="empty-subtitle text-secondary">
            {{ $body }}
        </p>
    @endif
    @isset($action)
        <div class="empty-action">
            {{ $action }}
        </div>
    @endisset
</div>
