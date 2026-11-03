<?php

namespace SilentOrchid\LedgerFox\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use SilentOrchid\LedgerFox\LedgerFoxServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            LedgerFoxServiceProvider::class,
        ];
    }
}
