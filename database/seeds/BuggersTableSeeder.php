<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class BuggersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // use this class as file name with a random line number
        $file  = ' in ' . base_path() . '/' . get_class($this) . ':' . rand(0, 50);
        $trace = ' Stack trace: ' .(new \Exception())->getTraceAsString();

        // Assemble emergency log message
        $message = 'Emergency-level logs are triggered when the system is unusable.';
        $class   = base_path() . '/' . 'ExampleEmergencyClass';
        $log     = $class . ': ' . $message . $file . $trace;

        Log::emergency($log);

        // Assemble alert log message
        $message = 'Alert-level logs are triggered when action must be taken immediately.' .
                   ' Example: Entire website down, database unavailable, etc.' .
                   ' This should trigger the SMS alerts and wake you up.';
        $class   = base_path() . '/' . 'ExampleAlertClass';
        $log     = $class . ': ' . $message . $file . $trace;
        Log::alert($log);

        // Assemble critical log message
        $message = 'Critical-level logs are triggered by critical conditions.' .
                   ' Example: Application component unavailable, unexpected exception.';
        $class   = base_path() . '/' . 'ExampleCriticalClass';
        $log     = $class . ': ' . $message . $file . $trace;
        Log::critical($log);

        // Assemble emergency log message
        $message = 'Error-level logs are triggered by runtime errors that do not require immediate action' .
                   ' but should typically be logged and monitored.';
        $class   = base_path() . '/' . 'ExampleErrorClass';
        $log     = $class . ': ' . $message . $file . $trace;
        Log::error($log);

        // Assemble emergency log message
        $message = 'Warning-level logs are triggered by exceptional occurrences that are not errors. ' .
                   'Examples: Use of deprecated APIs, poor use of an API, undesirable things that are not necessarily wrong.';
        $class   = base_path() . '/' . 'ExampleWarningClass';
        $log     = $class . ': ' . $message . $file . $trace;
        Log::warning($log);

        // Assemble notice log message
        $message = 'Notice-level logs are triggered by normal but significant events';
        $class = 'Example Notice Log';
        $log     = $class . ': ' . $message . $file . $trace;
        Log::notice($log);

        // Assemble info log message
        $message = 'Info-level logs are triggered by interesting events. Examples: User logs in, SQL logs.';
        $class   = 'Example Info Log';
        $log     = $class . ': ' . $message . $file . $trace;
        Log::info($log);

        // Assemble debug log message
        $message = 'Debug-level logs show detailed debug information.';
        $class   = 'Exmaple Debug Log';
        $log     = $class . ': ' . $message . $file . $trace;
        Log::debug($log);


    }
}
