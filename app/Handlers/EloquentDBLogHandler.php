<?php

namespace App\Handlers;

use App\Bugger;
use Monolog\Formatter\HtmlFormatter;
use Monolog\Handler\AbstractProcessingHandler;

class EloquentDBLogHandler extends AbstractProcessingHandler {


    /**
     * Writes the record down to the log of the implementing handler
     *
     * @param  array $record
     *
     * @return void
     */
    protected function write(array $record)
    {
        try {
            $bugger = Bugger::create($record);

        }
        catch (\Exception $e) {
            dump('An error occurred while logging an error. That\'s not good...');
        }


    }

    protected function getDefaultFormatter()
    {
        return new HtmlFormatter();
    }
}
