# AGENTS.md

## Project Intent

This is a vibe-code Laravel project. Optimize for fast iteration, clear code, and a smooth local developer experience.

The stack is:

- PHP 8.3+
- Laravel 13
- SQLite for development and production
- Blade views
- Raw CSS and jQuery
- Alpine.js for advanced client interactivity when needed
- Tabler for the admin UI
- Tabler Icons webfont for admin icons

There is intentionally no Vite, npm build step, or test suite.

## Development Rules

- Keep changes small, obvious, and easy to revise.
- Prefer Laravel conventions over custom framework code.
- Keep routes grouped under their domain. Admin routes live under the `admin.` route name prefix and `/admin` URL prefix.
- Keep admin pages protected by `auth` middleware.
- Use Blade, plain CSS in `public/css`, and plain JavaScript/jQuery in `public/js`.
- Keep public-facing Blade views under `resources/views/frontend`.
- Keep public-facing CSS under `public/css/frontend`.
- Link frontend CSS files directly from the public layout instead of using one stylesheet that imports the rest.
- Split frontend CSS by shared foundation/layout/components and by large page or feature files. Prefer small files such as `base.css`, `layout.css`, `buttons.css`, `home.css`, and `auth.css` over one growing stylesheet.
- Keep admin/backend CSS under `public/css/backend`.
- Use Alpine.js for stateful UI interactions that are awkward in jQuery, such as dropdown state, inline toggles, small reactive forms, previews, and conditional panels.
- Keep Alpine usage local to the Blade markup that needs it. Do not create a build step for Alpine.
- Do not add Vite, Tailwind, frontend bundlers, or Node dependencies unless explicitly requested.
- Do not add PHPUnit/Pest tests unless explicitly requested.
- When adding CDN-hosted library styles or scripts, use `https://cdn.jsdelivr.net` URLs.
- Use `./vendor/bin/pint --dirty` before handing off PHP changes.
- Use `php artisan route:list` and browser/manual checks instead of test commands for verification.
- If a database change is needed, create a Laravel migration and run `php artisan migrate`.
- Keep SQLite compatibility in mind. Avoid database features that are not portable to SQLite.

## Admin UI Rules

- Use Tabler classes and components for admin screens.
- Use Tabler Icons via `<i class="ti ti-name icon" aria-hidden="true"></i>`.
- Reuse shared Blade components for common states, especially `<x-admin.empty-state>`.
- Use `<x-admin.card>` for admin card structure instead of hand-writing repeated `.card`, `.card-header`, `.card-body`, and `.card-footer` wrappers. It supports title, header actions, content, footer text, and footer actions.
- Use `<x-admin.field>` for standard admin form rows with label, input slot, validation error, and optional hint. Use `<x-admin.field-error>` when only the validation message is needed.
- Use `<x-admin.input>` and `<x-admin.textarea>` for standard admin controls so Tabler `form-control` classes and invalid states stay consistent.
- Before adding a new admin UI component, check the official Tabler component templates at `https://docs.tabler.io/ui/components/***` and follow their HTML structure where practical. Relevant components include alerts, autosize, avatars, badges, breadcrumb, buttons, cards, carousel, charts, countup, data grid, divider, dropdowns, dropzone, empty states, icons, inline player, modals, offcanvas, pagination, placeholder, popovers, progress bars, range slider, ribbons, segmented control, spinners, statuses, steps, switch icon, tables, tabs, timelines, toasts, tooltips, and tracking.
- Do not inline SVG icons in Blade unless there is no Tabler icon available.
- Keep the admin horizontal nav compact.
- Group secondary admin areas under dropdown nav groups when possible.
- Avoid extra page title blocks when the card/table content already gives enough context.

## Settings Storage

Website settings are stored in `website_settings`.

- `key` is a unique string.
- `value` is JSON.
- Always store actual setting data under the `data` key:

```json
{"data": "Example value"}
```

Use `App\Models\WebsiteSetting::getData($key)` and `setData($key, $data)` instead of manually shaping the JSON.

## PageContent Collections

`page_content` stores one repeatable collection per row — not a whole page, and not multiple collections in one JSON blob.

- `key` uses `page.collection` format, such as `home.stats`, `home.slideshow`, or `features.steps`.
- `value` is the collection array itself. Example: `home.stats` stores `[{ "value": "100%", "label": "..." }]`, not `{ "stats": [...] }`.
- `description` explains which frontend page uses the collection and where it is rendered.
- Use `PageContent::getCollection($key)` and `PageContent::setCollection($key, $items, $description)` for one collection.
- Use `PageContent::collectionsForPage($page, $names)` in routes/controllers to load the collections a Blade view needs.
- Pass loaded data to Blade as `$collections`, keyed by the collection name after the dot. Example: `home.stats` becomes `$collections['stats']`.
- Keep `App\Models\PageContent` simple. Do not put page registries, default content maps, admin field schemas, field labels, form component metadata, editor rules, or other UI-heavy configuration in the model.
- Put starter collection records in seeders or migrations when needed. Keep schema/editor choices in the dedicated admin Blade/controller code.
- Map each known key to one schema in `PageContentController`. Reuse schema partials under `resources/views/admin/page-content/schemas/`.
- Use `<x-admin.repeatable-list>` for add/remove/reorder collection editing.
- Use the generic JSON editor only as a fallback for collection keys without a known schema yet.
- Keep public rendering in `resources/views/frontend`. Blade owns page structure and stable copy; PageContent only supplies loops.

### Keep in Blade

Put these directly in the frontend Blade view unless the developer explicitly asks otherwise:

- Page titles, hero copy, section headings, eyebrow labels, helper text, and structural UI copy
- Navigation links, contact details, addresses, phone numbers, deadlines, and footer copy
- Form labels, modal copy, button text, image paths, and layout markup
- Anything that should change with code review rather than through the admin UI

### Common collection schemas

Reuse these collection shapes when they fit:

- `slideshow`: `image`, `tag`, `caption`
- `features`: `title`, `body`
- `plans`: `name`, `price`, `summary`
- `testimonials`: `quote`, `name`, `role`
- `faq`: `question`, `answer`
- `stats`: `value`, `label`, optional `count`, `suffix`
- `steps`: `title`, `body`
- `documents`: plain checklist strings or `{ value }` rows normalized on save

Page-specific schemas are fine when needed. Example: `home.benefits` stores phased cards with `tag`, `num`, `sub`, and `items`.

### Key naming

- Prefix with the frontend page: `home`, `features`, `pricing`, etc.
- Suffix with the collection role: `stats`, `slideshow`, `faq`, `plans`, `testimonials`, `documents`.
- Good keys: `home.slideshow`, `features.features`, `pricing.plans`
- Avoid page-only keys like `home` or multi-collection blobs like `{ stats: [], faq: [] }` in one record.

Reusable PageContent admin components:

- `<x-admin.page-content.page-record>` renders the key and editable description card.
- `<x-admin.repeatable-list>` renders repeatable JSON array controls and exposes `item` and `index` to the slot for collection fields.

Use PageContent for:

- Repeatable lists that marketing/admin users may edit often: slideshows, feature grids, plan teasers, testimonials, FAQ rows, stats, checklist rows, and similar collection blocks.
- Page-local collection data that does not deserve its own model yet.

Do not use PageContent for:

- Whole-page CMS payloads where most strings live in JSON instead of Blade.
- Products, blogs, courses, leads, orders, users, or any transactional or searchable domain data.
- Website-wide settings. Use `website_settings` instead.
- Anything that needs relationships, filtering, permissions, lifecycle, or reporting. Give it a real Laravel model.

## Verification Checklist

For most changes, run:

```bash
./vendor/bin/pint --dirty
php artisan route:list
```

For UI changes, also check the running app in the browser at:

```text
http://127.0.0.1:8000
```
