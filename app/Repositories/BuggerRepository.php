<?php

namespace App\Repositories;

use App\Bugger;
use App\Transformers\BuggerTransformer;
use Illuminate\Http\Request;

class BuggerRepository implements BuggerRepositoryInterface
{


    /**
     * @var \App\Transformers\BuggerTransformer
     */
    protected $transformer;

    /**
     * @var \Illuminate\Http\Request|\Illuminate\Support\Facades\Request
     */
    protected $request;

    /**
     * BuggerRepository constructor.
     *
     * @param \Illuminate\Support\Facades\Request $request
     */
    public function __construct(BuggerTransformer $transformer, Request $request)
    {
        $this->transformer = $transformer;
        $this->request     = $request;
    }

    /**
     * Return a collection of all buggers in storage
     *
     * @return mixed
     */
    public function all()
    {
        if ($this->request->has('level_name')) {
            $buggers = Bugger::where('level_name', $this->request->input('level_name'))
                ->orderBy('created_at', 'desc')
                ->get();
        }
        else {
            $buggers = Bugger::orderBy('created_at', 'desc')->get();
        }

        return $buggers;
    }

    /**
     * Save a new bugger file in storage
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
        $bugger = Bugger::findOrFail($id);

        return $this->transformer->transform($bugger);
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
