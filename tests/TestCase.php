<?php

namespace Pownall\MagicLogin\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Pownall\MagicLogin\MagicLoginServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->withFactories(__DIR__.'/database/factories');
    }

    protected function getPackageProviders($app)
    {
        return [
            MagicLoginServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'sqlite');

        config()->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        config()->set('app.key', 'base64:lB4TIMlzgC9c8ZcGSlXSbuwJezmuQSM7OsvJsuD2GYs=');
    }
}
