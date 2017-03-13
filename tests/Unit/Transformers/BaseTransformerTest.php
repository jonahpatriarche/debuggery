<?php

namespace Tests\Unit;

use App\Bugger;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

abstract class BaseTransformerTest extends TestCase
{

    /**
     * Write a log entry with components specified by boolean parameters in standard error log format
     *  Example:
     *      '\path\to\ClassName: an error occurred in \path\to\file:[insert line number]. Stack trace:
     *          #1 line of stack trace
     *          #2 another line of stack trace...'
     *
     * @param string|null $level      - desired log level
     * @param string|null $message    - log message. If null, no message will be generated
     * @param string|null $class      - when given, prefix message with path to exception class and ': '
     * @param string|null $file       - when given, suffix message with ' in ' + path to this file
     * @param int|null    $line       - when given, suffix file with ':' + line
     * @param bool        $with_trace - when given, suffix message with stack trace
     */
    protected function createLogEntry(
        $level = 'ERROR',
        $message = null,
        $class = null,
        $file = null,
        $line = null,
        $with_trace = false
    ) {
        /**
         * If class is given, prefix it with base path.
         **/
        if ($class) {
            $class = $message ? // if message is not null, separate class and message with ': '
                base_path() . '/' . $class . ': ' :
                base_path() . '/' . $class;
        }

        $line  = $line ? ':' . $line : null;
        $file  = $file ? ' in ' . base_path() . '/' . $file . $line : null;
        $trace = $with_trace ? ' Stack trace: ' . (new \Exception())->getTraceAsString() : null;

        // assemble log message
        $log = $class . $message . $file . $trace;

        switch ($level) {
            case('EMERGENCY') :
                Log::emergency($log);
                break;

            case('ALERT') :
                Log::alert($log);
                break;

            case('CRITICAL') :
                Log::critical($log);
                break;

            case('ERROR') :
                Log::error($log);
                break;

            case('WARNING') :
                Log::warning($log);
                break;

            case('NOTICE') :
                Log::notice($log);
                break;

            case('INFO') :
                Log::info($log);
                break;

            case('DEBUG') :
                Log::debug($log);
                break;

            default:
                Log::error($log);
                break;
        }

    }

    /**
     * @return \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    protected function logModelNotFoundException()
    {
        $e = new ModelNotFoundException();
        $e->setModel(Bugger::class, 66);
        Log::error($e);

        return $e;
    }
}
