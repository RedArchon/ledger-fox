<?php

declare(strict_types=1);

namespace SilentOrchid\LedgerFox;

use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider;
use SilentOrchid\LedgerFox\Console\Commands\InstallCommand;

class LedgerFoxServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/ledger-fox.php', 'ledger-fox');

        $this->app->singleton(LedgerFox::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        AboutCommand::add('Ledger Fox', fn (): array => ['Version' => '1.x']);

        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../config/ledger-fox.php' => config_path('ledger-fox.php'),
        ], ['ledger-fox', 'ledger-fox-config']);

        $this->publishes([
            __DIR__.'/../stubs/cursor/rules' => base_path('.cursor/rules'),
        ], ['ledger-fox', 'ledger-fox-rules']);

        $this->publishes([
            __DIR__.'/../stubs/AGENTS.md' => base_path('AGENTS.md'),
        ], ['ledger-fox', 'ledger-fox-agents']);

        $this->commands([
            InstallCommand::class,
        ]);
    }
}
