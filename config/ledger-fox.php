<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Publish Cursor rules
    |--------------------------------------------------------------------------
    |
    | When true, `php artisan ledger-fox:install` publishes rule stubs into
    | `.cursor/rules/` at the application root.
    |
    */

    'publish_rules' => true,

    /*
    |--------------------------------------------------------------------------
    | Publish AGENTS.md
    |--------------------------------------------------------------------------
    |
    | When true, `php artisan ledger-fox:install` publishes a root AGENTS.md
    | stub (optional Cursor agent context file).
    |
    */

    'publish_agents' => true,

];
