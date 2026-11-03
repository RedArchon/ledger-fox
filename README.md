# Ledger Fox

Laravel package that publishes [Cursor](https://cursor.com) agent rules and agent configuration into your application.

Composer: `silent-orchid/ledger-fox`

## Requirements

- PHP 8.2+
- Laravel 11 or 12

## Installation

```bash
composer require silent-orchid/ledger-fox
```

The service provider is auto-discovered.

## Publish

Install Cursor rules (`.cursor/rules/*.mdc`), optional root `AGENTS.md`, and package config:

```bash
php artisan ledger-fox:install
```

Overwrite existing files:

```bash
php artisan ledger-fox:install --force
```

Publish selectively:

```bash
php artisan ledger-fox:install --rules-only
php artisan ledger-fox:install --agents-only
php artisan ledger-fox:install --config-only
```

Or use Laravel tags directly:

```bash
php artisan vendor:publish --tag=ledger-fox-rules
php artisan vendor:publish --tag=ledger-fox-agents
php artisan vendor:publish --tag=ledger-fox-config
```

### What gets published

| Tag | Destination |
|-----|-------------|
| `ledger-fox-rules` | `.cursor/rules/*.mdc` |
| `ledger-fox-agents` | `AGENTS.md` (application root) |
| `ledger-fox-config` | `config/ledger-fox.php` |

Shipped rule content is intentionally placeholder-only so you can replace it with real project guidance later.

## Configuration

```php
// config/ledger-fox.php
'publish_rules' => true,
'publish_agents' => true,
```

## Development

```bash
composer install
composer test
```

## License

MIT. See [LICENSE.md](LICENSE.md).
