<?php

namespace app\Handlers;

use Monolog\Handler\AbstractProcessingHandler;

class NotificationLogHandler extends AbstractProcessingHandler {


    /**
     * Writes the record down to the log of the implementing handler
     *
     * @param  array $record
     *
     * @return void
     */
    protected function write(array $record)
    {

    }
}
