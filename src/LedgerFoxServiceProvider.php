<?php

namespace SilentOrchid\LedgerFox;

use Illuminate\Support\ServiceProvider;
use SilentOrchid\LedgerFox\Commands\InstallCommand;

class LedgerFoxServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/ledger-fox.php', 'ledger-fox');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/ledger-fox.php' => config_path('ledger-fox.php'),
            ], 'ledger-fox-config');

            $this->publishes([
                __DIR__.'/../stubs/cursor/rules' => base_path('.cursor/rules'),
            ], 'ledger-fox-rules');

            $this->publishes([
                __DIR__.'/../stubs/AGENTS.md' => base_path('AGENTS.md'),
            ], 'ledger-fox-agents');

            $this->commands([
                InstallCommand::class,
            ]);
        }
    }
}
