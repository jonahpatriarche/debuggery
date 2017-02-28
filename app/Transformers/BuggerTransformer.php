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

        list($error, $trace_string) = explode('Stack trace:', $str);
        list($msg, $file) = explode(' in ', $error);
        list($class, $error) = explode(':', $msg);
        $trace_lines = explode('#', $trace_string);

        $trace = $this->transformTrace($trace_lines);

        // Extract the name of the class from the error path
        $class = last(explode('\\', $class));

        // Strip the base path off of the file name
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
     * Remove first instance of base path from string or array of strings and trim the resulting string
     *  - NOTE: any characters that precede the base path will be lost
     *
     * @param string|array $path
     *
     * @return mixed
     */
    private function stripBasePath($path)
    {
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

        if (str_contains($path, base_path())) {
            return last(explode(base_path(), $path));
        }

        return $path;
    }

    /**
     * Use delimited to split lines of trace into arrays of trimmed strings
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
