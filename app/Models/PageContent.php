<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['key', 'value', 'description'])]
class PageContent extends Model
{
    protected $table = 'page_content';

    protected function casts(): array
    {
        return [
            'value' => 'array',
        ];
    }

    public static function getCollection(string $key): array
    {
        $value = static::query()->where('key', $key)->value('value');

        return is_array($value) ? $value : [];
    }

    public static function setCollection(string $key, array $items, ?string $description = null): self
    {
        $payload = ['value' => array_values($items)];

        if ($description !== null) {
            $payload['description'] = $description;
        }

        return static::query()->updateOrCreate(['key' => $key], $payload);
    }

    /**
     * @param  list<string>  $names
     * @return array<string, array<int, mixed>>
     */
    public static function collectionsForPage(string $page, array $names): array
    {
        $collections = [];

        foreach ($names as $name) {
            $collections[$name] = static::getCollection("{$page}.{$name}");
        }

        return $collections;
    }

    public function pagePrefix(): string
    {
        return str($this->key)->before('.')->toString();
    }

    public function collectionName(): string
    {
        return str($this->key)->after('.')->toString();
    }

    public function displayName(): string
    {
        return str($this->collectionName())->headline()
            .' · '
            .str($this->pagePrefix())->headline();
    }
}
