@props([
    'text' => '',
    'inline' => true,
])

@php
    $html = \App\Support\CollectionText::render($text, $inline);
    $classes = $inline ? 'markdown-text' : 'markdown-text markdown-text--block';
@endphp

<span {{ $attributes->class([$classes]) }}>{!! $html !!}</span>