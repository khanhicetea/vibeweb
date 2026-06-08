# Vibe Web

A small Laravel 13 vibe-code project optimized for fast local iteration.

## Stack

- PHP 8.3+
- Laravel 13
- SQLite for development and production
- Blade
- Raw CSS
- jQuery
- Tabler admin UI
- Tabler Icons webfont

No Vite. No npm build step. No test suite.

## Local Development

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan serve
```

Open:

```text
http://127.0.0.1:8000
```

## Useful Commands

```bash
composer dev
php artisan migrate
php artisan db:seed
./vendor/bin/pint --dirty
php artisan route:list
```

The seeder creates a local admin account:

```text
admin@example.com
password
```

## Agent Notes

See `AGENTS.md` for coding-agent rules and project conventions.
