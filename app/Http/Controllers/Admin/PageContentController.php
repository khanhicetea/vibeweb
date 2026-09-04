<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use JsonException;

class PageContentController extends Controller
{
    public function index(): View
    {
        return view('admin.page-content.index', [
            'groups' => PageContent::query()
                ->orderBy('key')
                ->get()
                ->groupBy(fn (PageContent $pageContent) => $pageContent->pagePrefix()),
        ]);
    }

    public function edit(PageContent $pageContent): View
    {
        $schema = $this->schemaFor($pageContent->key);

        if ($schema === null) {
            return view('admin.page-content.edit-json', [
                'pageContent' => $pageContent,
                'json' => json_encode($pageContent->value, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
            ]);
        }

        return view('admin.page-content.edit-collection', [
            'pageContent' => $pageContent,
            'schema' => $schema,
            'items' => old('items', PageContent::getCollection($pageContent->key)),
        ]);
    }

    public function update(Request $request, PageContent $pageContent): RedirectResponse
    {
        $schema = $this->schemaFor($pageContent->key);

        if ($schema === null) {
            return $this->updateJson($request, $pageContent);
        }

        $attributes = $request->validate([
            'description' => ['nullable', 'string', 'max:500'],
            ...$this->validationRulesFor($schema),
        ]);

        PageContent::setCollection(
            $pageContent->key,
            $this->normalizeItems($schema, data_get($attributes, 'items', [])),
            $attributes['description'] ?? $pageContent->description,
        );

        return redirect()
            ->route('admin.page-content.edit', $pageContent)
            ->with('status', 'Collection saved.');
    }

    private function schemaFor(string $key): ?string
    {
        return match ($key) {
            'home.hero_points' => 'hero_points',
            'home.hero_stats' => 'stats',
            'home.services' => 'services',
            'home.steps' => 'steps',
            'home.stats' => 'stats',
            'home.testimonials' => 'testimonials',
            'recruit.hero_stats' => 'stats',
            'recruit.values' => 'services',
            'recruit.perks' => 'hero_points',
            'recruit.roles' => 'roles',
            'recruit.steps' => 'steps',
            default => null,
        };
    }

    private function validationRulesFor(string $schema): array
    {
        return match ($schema) {
            'stats' => [
                'items' => ['array', 'max:6'],
                'items.*.value' => ['nullable', 'string', 'max:30'],
                'items.*.label' => ['nullable', 'string', 'max:80'],
                'items.*.count' => ['nullable'],
                'items.*.suffix' => ['nullable', 'string', 'max:10'],
            ],
            'hero_points' => [
                'items' => ['array', 'max:6'],
                'items.*.value' => ['nullable', 'string', 'max:80'],
            ],
            'services', 'steps' => [
                'items' => ['array', 'max:8'],
                'items.*.title' => ['nullable', 'string', 'max:90'],
                'items.*.body' => ['nullable', 'string', 'max:500'],
            ],
            'testimonials' => [
                'items' => ['array', 'max:8'],
                'items.*.quote' => ['nullable', 'string', 'max:320'],
                'items.*.name' => ['nullable', 'string', 'max:80'],
                'items.*.role' => ['nullable', 'string', 'max:120'],
            ],
            'roles' => [
                'items' => ['array', 'max:8'],
                'items.*.title' => ['nullable', 'string', 'max:90'],
                'items.*.team' => ['nullable', 'string', 'max:60'],
                'items.*.type' => ['nullable', 'string', 'max:40'],
                'items.*.location' => ['nullable', 'string', 'max:60'],
                'items.*.body' => ['nullable', 'string', 'max:300'],
            ],
            default => [
                'items' => ['array'],
            ],
        };
    }

    private function normalizeItems(string $schema, array $items): array
    {
        return match ($schema) {
            'hero_points' => $this->normalizeValueList($items),
            'testimonials' => collect($items)
                ->map(fn (array $item) => array_filter([
                    'quote' => $item['quote'] ?? null,
                    'name' => $item['name'] ?? null,
                    'role' => $item['role'] ?? null,
                ], fn ($value) => filled($value)))
                ->filter(fn (array $item) => $item !== [])
                ->values()
                ->all(),
            'roles' => collect($items)
                ->map(fn (array $item) => array_filter([
                    'title' => $item['title'] ?? null,
                    'team' => $item['team'] ?? null,
                    'type' => $item['type'] ?? null,
                    'location' => $item['location'] ?? null,
                    'body' => $item['body'] ?? null,
                ], fn ($value) => filled($value)))
                ->filter(fn (array $item) => $item !== [])
                ->values()
                ->all(),
            default => array_values($items),
        };
    }

    private function normalizeValueList(mixed $items): array
    {
        return collect($items)
            ->map(fn ($item) => is_array($item) ? ($item['value'] ?? '') : (string) $item)
            ->filter(fn (string $item) => $item !== '')
            ->values()
            ->all();
    }

    private function updateJson(Request $request, PageContent $pageContent): RedirectResponse
    {
        $attributes = $request->validate([
            'description' => ['nullable', 'string', 'max:500'],
            'json' => ['required', 'string'],
        ]);

        try {
            $data = json_decode($attributes['json'], true, flags: JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            return back()
                ->withInput()
                ->withErrors(['json' => 'Enter valid JSON.']);
        }

        if (! is_array($data)) {
            return back()
                ->withInput()
                ->withErrors(['json' => 'The JSON must decode to an object or array.']);
        }

        PageContent::setCollection(
            $pageContent->key,
            $data,
            $attributes['description'] ?? $pageContent->description,
        );

        return redirect()
            ->route('admin.page-content.edit', $pageContent)
            ->with('status', 'Collection saved.');
    }
}
