<?php

namespace Uchup07\LaravelZoom\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Uchup07\LaravelZoom\LaravelZoom
 */
class LaravelZoom extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Uchup07\LaravelZoom\LaravelZoom::class;
    }
}
