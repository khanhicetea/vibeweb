<?php

namespace App\Support;

use Illuminate\Support\Str;

class CollectionText
{
    public static function render(?string $text, bool $inline = true): string
    {
        if (! filled($text)) {
            return '';
        }

        return $inline
            ? Str::inlineMarkdown($text)
            : Str::markdown($text);
    }
}
