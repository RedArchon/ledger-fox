<?php

declare(strict_types=1);

use SilentOrchid\LedgerFox\LedgerFox;

afterEach(function () {
    $paths = [
        base_path('.cursor/rules/core.mdc'),
        base_path('.cursor/rules/testing.mdc'),
        base_path('AGENTS.md'),
        config_path('ledger-fox.php'),
    ];

    foreach ($paths as $path) {
        if (is_file($path)) {
            unlink($path);
        }
    }

    $rulesDir = base_path('.cursor/rules');

    if (is_dir($rulesDir)) {
        @rmdir($rulesDir);
    }

    $cursorDir = base_path('.cursor');

    if (is_dir($cursorDir)) {
        @rmdir($cursorDir);
    }
});

it('resolves the singleton', function () {
    expect(app(LedgerFox::class))->toBeInstanceOf(LedgerFox::class);
});

it('returns the same instance from the container', function () {
    expect(app(LedgerFox::class))->toBe(app(LedgerFox::class));
});

it('merges the package config', function () {
    expect(config('ledger-fox.publish_rules'))->toBeTrue()
        ->and(config('ledger-fox.publish_agents'))->toBeTrue();
});

it('registers the install command', function () {
    $this->artisan('list')
        ->expectsOutputToContain('ledger-fox:install')
        ->assertSuccessful();
});

it('publishes rules, agents, and config via install', function () {
    $this->artisan('ledger-fox:install')
        ->assertSuccessful();

    expect(file_exists(base_path('.cursor/rules/core.mdc')))->toBeTrue()
        ->and(file_exists(base_path('.cursor/rules/testing.mdc')))->toBeTrue()
        ->and(file_exists(base_path('AGENTS.md')))->toBeTrue()
        ->and(file_exists(config_path('ledger-fox.php')))->toBeTrue();
});

it('publishes rules only when requested', function () {
    $this->artisan('ledger-fox:install', ['--rules-only' => true])
        ->assertSuccessful();

    expect(file_exists(base_path('.cursor/rules/core.mdc')))->toBeTrue()
        ->and(file_exists(config_path('ledger-fox.php')))->toBeFalse()
        ->and(file_exists(base_path('AGENTS.md')))->toBeFalse();
});

it('publishes all resources via the ledger-fox tag', function () {
    $this->artisan('vendor:publish', ['--tag' => 'ledger-fox'])
        ->assertSuccessful();

    expect(file_exists(base_path('.cursor/rules/core.mdc')))->toBeTrue()
        ->and(file_exists(base_path('AGENTS.md')))->toBeTrue()
        ->and(file_exists(config_path('ledger-fox.php')))->toBeTrue();
});
