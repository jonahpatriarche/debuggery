<?php

namespace App\Handlers;

use App\Bugger;
use Monolog\Formatter\HtmlFormatter;
use Monolog\Formatter\JsonFormatter;
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
            Bugger::create(array_except($record,['channel', 'context', 'datetime', 'extra']));
        }
        catch (\Exception $e) {
            dump($e->getMessage());
        }


    }

    protected function getDefaultFormatter()
    {
        return new JsonFormatter();
    }
}
