<?php

namespace App\Transformers;

class LogEntryTransformer extends BaseEloquentTransformer implements TransformerInterface
{

    /**
     * Transform log item
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
            'level_name'  => $item['level_name'],
            'level_image' => is_object($item) ? $item->levelImage() : 'question-sign',
            'log_id'      => $item['log_id'],
            'bugger_id'   => $item['bugger_id'],
            'date'        => $item['created_at'],
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
}
