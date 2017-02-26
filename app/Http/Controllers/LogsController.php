<?php

namespace App\Http\Controllers;

use App\Repositories\LogRepositoryInterface;

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

    /**
     * Return a view with a transformed list of all logs in storage
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = $this->logs->all();

        return view('logs.index')
            ->with('logs', $data);
    }

    /**
     * Return transformed data for a single log entry
     * @TODO - create a show view
     *
     * @param $id
     *
     * @return mixed
     */
    public function show($id)
    {
        $data = $this->logs->find($id);

        return $data;
    }
}
