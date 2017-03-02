<?php

namespace App\Transformers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BuggerTransformer extends BaseEloquentTransformer implements TransformerInterface
{

    /**
     * Transform bugger item
     *
     * @param array $item
     *
     * @return array $response
     */
    public function item($item)
    {
        $str = $item['message'];

        /**
         * Check for stack trace
         */
        if (str_contains($str, 'Stack trace')) {
            list($error, $trace_string) = explode('Stack trace:', $str);
            $trace_lines = explode('#', $trace_string);
            $trace = $this->transformTrace($trace_lines);
        }
        else {
            $error = $str;
            $trace = [];
        }

        /**
         * Check for file name
         *  ex: 'DeveloperException in app/BadCode.php(22)...'
         */
        if (str_contains($error, ' in ')) {
            list($msg, $file) = explode(' in ', $error);
        }
        else {
            $msg = $error;
            $file = null;
        }

        /**
         * Check for Error class
         *  ex: 'BadMethodCallException: blah blah something blew up blah blah blah...'
         */
        if (str_contains($msg, ':')) {
            list($class, $error) = explode(':', $msg);
        }
        else {
            $class = 'Unknown';
            $error = $msg;
        }

        /**
         * Extract the name of the class from the end of the error path
         */
        $class = last(explode('\\', $class));

        /**
         * Strip the base path off of the file name
         **/
        $file = $this->stripBasePath($file);

        $response = [
            'error_class' => $class,
            'message'     => $error,
            'file'        => $file,
            'trace'       => $trace,
            'level_name'  => strtolower($item['level_name']),
            'level_icon'  => is_object($item) ? $item->levelImage() : 'fa fa-warning',
            'bugger_id'   => $item['id'],
            'date'        => $this->transformDateString($item),
            'context'     => $item['context']
        ];

        return $response;
    }

    /**
     * Remove base path from string or array of strings and trim the result
     *
     * @param string|array $path
     *
     * @return mixed
     */
    private function stripBasePath($path)
    {
        /**
         * When given array of string, check each for base path and call this method recursively
         */
        if (is_array($path)) {
            $array = [];
            foreach ($path as $value) {
                if (str_contains($value, base_path())) {
                    $value = $this->stripBasePath($value);
                }

                $value = trim($value);

                if ($value != "") {
                    array_push($array, $value);

                }
            }

            return $array;
        }

        /**
         * Remove instances of base path from the error message
         * - explode string around base path
         * - remove base path
         * - stick string back together
         */
        if (str_contains($path, base_path())) {
            $str_array = explode(base_path(), $path);
            array_forget($str_array, base_path());
            $path = implode($str_array);
        }

        return $path;
    }

    /**
     * Use delimiter to split lines of trace into arrays of trimmed strings
     *
     * @param $trace_lines
     *
     * @return array
     */
    private function transformTrace($trace_lines, $delimiter = ':')
    {
        $trace = [];
        foreach ($trace_lines as $line) {
            $line = explode($delimiter, $line);
            $line = $this->stripBasePath($line);

            // Skip empty arrays and empty strings
            if (sizeof($line) > 0) {
                array_push($trace, $line);
            }

        }

        return $trace;
    }

    /**
     * Parses date into a readable string in the user's timezone (or PST if no user)
     *
     * @param $item
     *
     * @return string
     */
    private function transformDateString($item)
    {
        $timezone = Auth::check() ? Auth::user()->timezone : 'PST';

        return Carbon::parse($item['created_at'])
            ->timezone($timezone)
            ->toDayDateTimeString();
    }
}
