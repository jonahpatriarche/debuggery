<?php

namespace App\Http\Controllers;

use App\Repositories\LogRepositoryInterface;
use App\Transformers\LogEntryTransformer;

class LogsController extends Controller
{

    /**
     * @var \App\Repositories\LogRepositoryInterface
     */
    protected $logs;

    /**
     * LogsController constructor.
     *
     * @param \App\Repositories\LogRepositoryInterface $logs
     */
    public function __construct(LogRepositoryInterface $logs)
    {
        $this->logs = $logs;
    }

    public function index()
    {
        $data = $this->logs->all();

        return view('logs.index')
            ->with('logs', $data);
    }

    public function show($id)
    {
        $data = $this->logs->find($id);

        return $data;
    }
}
