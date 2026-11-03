<div align="center">
    <h1>Ledger Fox</h1>
</div>

<p align="center">
    <a href="https://packagist.org/packages/silent-orchid/ledger-fox"><img src="https://img.shields.io/packagist/v/silent-orchid/ledger-fox.svg?style=flat-square" alt="Packagist"></a>
    <a href="https://packagist.org/packages/silent-orchid/ledger-fox"><img src="https://img.shields.io/packagist/php-v/silent-orchid/ledger-fox.svg?style=flat-square" alt="PHP from Packagist"></a>
    <a href="https://github.com/RedArchon/ledger-fox/actions"><img alt="GitHub Workflow Status (main)" src="https://img.shields.io/github/actions/workflow/status/RedArchon/ledger-fox/tests.yml?branch=main&label=Tests&style=flat-square"></a>
    <a href="https://packagist.org/packages/silent-orchid/ledger-fox"><img src="https://img.shields.io/packagist/dt/silent-orchid/ledger-fox.svg?style=flat-square" alt="Total Downloads"></a>
</p>

Publish Cursor agent rules and configuration into a Laravel application.

## Requirements

- PHP 8.3+
- Laravel 12 or 13

## Installation

You can install the package via Composer:

```bash
composer require silent-orchid/ledger-fox
```

Until the package is on Packagist, require it from GitHub:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/RedArchon/ledger-fox"
        }
    ],
    "require": {
        "silent-orchid/ledger-fox": "dev-main"
    }
}
```

The service provider is registered automatically via Laravel package discovery.

## Publishing

Publish all of the package's resources at once:

```bash
php artisan vendor:publish --tag="ledger-fox"
```

Or publish each resource individually:

```bash
php artisan vendor:publish --tag="ledger-fox-config"
php artisan vendor:publish --tag="ledger-fox-rules"
php artisan vendor:publish --tag="ledger-fox-agents"
```

You may also publish everything defined by the service provider:

```bash
php artisan vendor:publish --provider="SilentOrchid\LedgerFox\LedgerFoxServiceProvider"
```

Convenience installer (wraps the same publish tags):

```bash
php artisan ledger-fox:install
php artisan ledger-fox:install --force
php artisan ledger-fox:install --rules-only
php artisan ledger-fox:install --agents-only
php artisan ledger-fox:install --config-only
```

### What gets published

| Tag | Destination |
|-----|-------------|
| `ledger-fox` | All publishable resources |
| `ledger-fox-config` | `config/ledger-fox.php` |
| `ledger-fox-rules` | `.cursor/rules/*.mdc` |
| `ledger-fox-agents` | `AGENTS.md` (application root) |

Shipped rule content is placeholder-only so you can replace it with project guidance later.

## Configuration

```php
// config/ledger-fox.php
'publish_rules' => true,
'publish_agents' => true,
```

## Development

This package follows the [official Laravel package skeleton](https://github.com/laravel/package-skeleton).

```bash
composer install
composer test
composer serve
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Thank you for considering contributing to Ledger Fox! Please review our [contributing guide](.github/CONTRIBUTING.md) to get started.

## Security Vulnerabilities

Please review [our security policy](.github/SECURITY.md) on how to report security vulnerabilities.

## Credits

- [Silent Orchid](https://github.com/RedArchon)
- [All Contributors](../../contributors)

## License

Ledger Fox is open-sourced software licensed under the [MIT license](LICENSE.md).
