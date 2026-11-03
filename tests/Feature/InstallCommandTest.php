<?php

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

it('registers the install command', function () {
    $this->artisan('list')
        ->expectsOutputToContain('ledger-fox:install')
        ->assertSuccessful();
});

it('publishes rules, agents, and config', function () {
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
