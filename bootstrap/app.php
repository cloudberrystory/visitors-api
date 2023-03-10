<?php

require_once __DIR__.'/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->configure('app');
$app->configure('database');
$app->configure('countries');

$app->register(\Illuminate\Redis\RedisServiceProvider::class);

$app->singleton(\Illuminate\Redis\Connections\PhpRedisConnection::class, function ($app) {
    return $app['redis']->connection();
});

$app->singleton(\App\Storages\CounterStorage::class, function ($app) {
    return $app->make(\App\Storages\RedisCounterStorage::class);
});

$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/api.php';
});

return $app;
