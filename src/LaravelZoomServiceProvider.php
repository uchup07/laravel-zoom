<?php

namespace Uchup07\LaravelZoom;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Uchup07\LaravelZoom\Commands\LaravelZoomCommand;

class LaravelZoomServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-zoom')
            ->hasConfigFile('laravel-zoom');
        //            ->hasViews()
        //            ->hasMigration('create_laravel_zoom_table')
        //            ->hasCommand(LaravelZoomCommand::class);
    }
}
