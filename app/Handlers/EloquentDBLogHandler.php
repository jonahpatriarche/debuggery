<?php

namespace App\Handlers;

use App\LogEntry;
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
            $log = LogEntry::create($record);

        }
        catch (\Exception $e) {
            dump('errors recording errors are never good.');
        }


    }

    protected function getDefaultFormatter()
    {
        return new HtmlFormatter();
    }
}
