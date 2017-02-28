<?php

namespace App\Http\Controllers;

use App\Repositories\BuggerRepositoryInterface;
use App\Transformers\BuggerTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Response as HTTP;

class BuggersController extends Controller
{

    /**
     * @var \App\Repositories\BuggerRepositoryInterface
     */
    protected $buggers;


    /**
     * BuggersController constructor.
     *
     * @param \App\Repositories\BuggerRepositoryInterface $buggers
     * @param \App\Transformers\BuggerTransformer    $transformer
     */
    public function __construct(BuggerRepositoryInterface $buggers, BuggerTransformer $transformer)
    {
        $this->buggers = $buggers;
        $this->transformer = $transformer;
    }

    /**
     * Return a view with a transformed list of all buggers in storage
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $buggers = $this->buggers->all();
        $buggers = $this->transformer->transform($buggers);

        return view('buggers.index')
            ->with('buggers', $buggers);
    }

    /**
     * Return transformed data for a single bugger entry
     *
     * @param $id
     *
     * @return mixed
     */
    public function show($id)
    {
        $data = $this->buggers->find($id);

        return view('buggers.show')
            ->with('bugger', $data);
    }
}
