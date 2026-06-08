<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['key', 'value'])]
class WebsiteSetting extends Model
{
    public const DEFINITIONS = [
        'site.title' => [
            'group' => 'Website',
            'label' => 'Website title',
            'type' => 'text',
            'default' => 'VibeWeb',
        ],
        'site.tagline' => [
            'group' => 'Website',
            'label' => 'Tagline',
            'type' => 'text',
            'default' => 'Simple PHP app with SQLite, Blade, and no build step.',
        ],
        'site.contact_email' => [
            'group' => 'Website',
            'label' => 'Contact email',
            'type' => 'email',
            'default' => 'hello@example.com',
        ],
        'seo.meta_title' => [
            'group' => 'SEO',
            'label' => 'Meta title',
            'type' => 'text',
            'default' => 'VibeWeb',
        ],
        'seo.meta_description' => [
            'group' => 'SEO',
            'label' => 'Meta description',
            'type' => 'textarea',
            'default' => 'A lean Laravel starter with SQLite, Blade, raw CSS, jQuery, and a Tabler admin area.',
        ],
        'seo.meta_keywords' => [
            'group' => 'SEO',
            'label' => 'Meta keywords',
            'type' => 'text',
            'default' => 'laravel, sqlite, admin',
        ],
    ];

    protected function casts(): array
    {
        return [
            'value' => 'array',
        ];
    }

    public static function getData(string $key): mixed
    {
        $setting = static::query()->where('key', $key)->first();

        return $setting?->value['data'] ?? static::DEFINITIONS[$key]['default'] ?? null;
    }

    public static function setData(string $key, mixed $data): self
    {
        return static::query()->updateOrCreate(
            ['key' => $key],
            ['value' => ['data' => $data]],
        );
    }

    /**
     * @return array<string, array<int, array{key: string, label: string, type: string, value: mixed}>>
     */
    public static function groupedForForm(): array
    {
        $stored = static::query()
            ->whereIn('key', array_keys(static::DEFINITIONS))
            ->get()
            ->keyBy('key');

        $groups = [];

        foreach (static::DEFINITIONS as $key => $definition) {
            $groups[$definition['group']][] = [
                'key' => $key,
                'label' => $definition['label'],
                'type' => $definition['type'],
                'value' => $stored->get($key)?->value['data'] ?? $definition['default'],
            ];
        }

        return $groups;
    }
}
