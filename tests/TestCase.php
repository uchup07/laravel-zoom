<?php

namespace Uchup07\LaravelZoom\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Uchup07\LaravelZoom\LaravelZoomServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Uchup07\\LaravelZoom\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelZoomServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        config()->set('laravel-zoom.account_id', 'account_id');
        config()->set('laravel-zoom.credentials', 'credentials==');
        config()->set('laravel-zoom.api_url', 'https://api.zoom.us/v2/');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-zoom_table.php.stub';
        $migration->up();
        */
    }
}
