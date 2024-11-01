<?php

namespace Uchup07\LaravelZoom\Commands;

use Illuminate\Console\Command;

class LaravelZoomCommand extends Command
{
    public $signature = 'laravel-zoom';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
