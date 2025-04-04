<?php

/*
|--------------------------------------------------------------------------
| Register Namespaces And Routes
|--------------------------------------------------------------------------
|
| When a module starting, this file will execute automatically. This helps
| to register some namespaces like translator or view. Also, this file
| will load the routes file for each module. You may also modify
| this file as you want.
|
*/

// Make sure routes are not cached
if (!app()->routesAreCached()) {
    require __DIR__ . '/Http/routes.php';
}

/*
|--------------------------------------------------------------------------
| Register Migrations
|--------------------------------------------------------------------------
|
| Register module migrations so they can be run when migrations are executed.
|
*/

$migrations_path = __DIR__.'/Database/Migrations';

if (is_dir($migrations_path)) {
    $this->loadMigrationsFrom($migrations_path);
}
