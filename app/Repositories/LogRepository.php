<?php

namespace App\Repositories;

use App\LogEntry;
use App\Transformers\LogEntryTransformer;
use Illuminate\Http\Request;

class LogRepository extends RepositoryAbstract implements LogRepositoryInterface
{


    /**
     * @var \App\Transformers\LogEntryTransformer
     */
    protected $transformer;

    /**
     * LogRepository constructor.
     *
     * @param \Illuminate\Support\Facades\Request $request
     */
    public function __construct(LogEntryTransformer $transformer, Request $request)
    {
        parent::__construct($request);
        $this->transformer = $transformer;
    }

    /**
     * Return a collection of all logs in storage
     *
     * @return mixed
     */
    public function all()
    {
        if($this->request->has('level_name')){
            $logs = LogEntry::where('level_name', $this->request->input('level_name'))
                ->get();
        }
        else {
            $logs = LogEntry::all();
        }

        $logs = $this->transformer->transform($logs);

        return $logs['data'];
    }

    /**
     * Save a new log file in storage
     *
     * @return mixed
     */
    public function upload()
    {
        //
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function find($id)
    {
        $log = LogEntry::findOrFail($id);

        return $this->transformer->transform($log);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function delete($id)
    {

    }
}
