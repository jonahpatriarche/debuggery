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
        $log_message = $item['message'];

        list($message, $trace) = $this->getStackTrace($log_message);
        list($error_message, $file) = $this->getErrorFile($message);
        list($err_msg_class, $err_msg_body) = $this->getErrorClassName($error_message);


        /**
         * Extract the name of the class from the end of the error path
         */
        $err_msg_class = last(explode('\\', $err_msg_class));

        /**
         * Strip the base path off of the file name
         **/
        $file = $this->stripBasePath($file);

        $response = [
            'error_class' => $err_msg_class,
            'message'     => $err_msg_body,
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
     * Split message into error message and file name using ' in ' as default delimiter
     *  - if delimiter not present, set file to null and use entire message as error message
     *
     * @param string $message - 'DeveloperException: You did something super wrong in app/BadCode.php(22)...'
     */
    private function getErrorFile($message, $delimiter = ' in ')
    {
        if (str_contains($message, $delimiter)) {
            list($error_message, $file) = explode($delimiter, $message);
        }
        else {
            $error_message = $message;
            $file          = null;
        }

        return [$error_message, $file];
    }

    /**
     * Split the error class from the error message body using ': ' as delimiter
     *  - if delimiter not present, set both class and msg to the whole message
     *
     * @param $message - 'BadMethodCallException: blah blah something blew up blah blah blah...'
     *
     * @return array
     */
    private function getErrorClassName($message, $delimiter = ': ')
    {
        if (str_contains($message, $delimiter)) {
            list($err_msg_class, $err_msg_body) = explode($delimiter, $message);
        }
        else {
            $err_msg_class = $message;
            $err_msg_body  = $message;
        }

        return [$err_msg_class, $err_msg_body];
    }

    /**
     * Split log message into error message and stack trace using 'Stack trace: ' as delimiter
     *  - trace is returned as an array of strings that represent each line of the stack trace
     *  - if delimiter not present, use the entire log message and set trace to empty array
     */
    private function getStackTrace($log_message, $delimiter = 'Stack trace: ')
    {
        if (str_contains($log_message, $delimiter)) {
            list($message, $trace_string) = explode($delimiter, $log_message);
            $trace_lines = explode('#', $trace_string);
            $trace       = $this->transformTraceLines($trace_lines);
        }
        else {
            $message = $log_message;
            $trace   = [];
        }

        return [$message, $trace];
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
         * - remove spaces and white space characters from either end of string
         */
        if (str_contains($path, base_path())) {
            $str_array = explode(base_path(), $path);
            array_forget($str_array, base_path());
            $path = rtrim(implode($str_array), ' ');
        }

        return $path;
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

    /**
     * Tidy up lines of stack trace
     *  - remove empty lines
     *  - remove all instances of base path
     *  - trim whitespace off start and end of string
     *
     * @param $trace_lines
     *
     * @return array
     */
    private function transformTraceLines($trace_lines)
    {
        $trace = [];
        foreach ($trace_lines as $line) {
            $line = $this->stripBasePath($line);

            // Skip empty arrays and empty strings
            if (sizeof($line) > 0) {
                array_push($trace, $line);
            }

        }

        return $trace;
    }
}
