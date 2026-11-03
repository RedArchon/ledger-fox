<?php

namespace SilentOrchid\LedgerFox\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'ledger-fox:install
                            {--force : Overwrite existing published files}
                            {--rules-only : Publish Cursor rules only}
                            {--agents-only : Publish AGENTS.md only}
                            {--config-only : Publish config only}';

    protected $description = 'Publish Ledger Fox Cursor rules and agent configuration into the application';

    public function handle(): int
    {
        $force = (bool) $this->option('force');
        $rulesOnly = (bool) $this->option('rules-only');
        $agentsOnly = (bool) $this->option('agents-only');
        $configOnly = (bool) $this->option('config-only');

        $publishAll = ! $rulesOnly && ! $agentsOnly && ! $configOnly;

        if ($publishAll || $configOnly) {
            $this->call('vendor:publish', [
                '--tag' => 'ledger-fox-config',
                '--force' => $force,
            ]);
        }

        if (($publishAll || $rulesOnly) && config('ledger-fox.publish_rules', true)) {
            $this->call('vendor:publish', [
                '--tag' => 'ledger-fox-rules',
                '--force' => $force,
            ]);
        }

        if (($publishAll || $agentsOnly) && config('ledger-fox.publish_agents', true)) {
            $this->call('vendor:publish', [
                '--tag' => 'ledger-fox-agents',
                '--force' => $force,
            ]);
        }

        $this->components->info('Ledger Fox publish complete.');

        return self::SUCCESS;
    }
}
