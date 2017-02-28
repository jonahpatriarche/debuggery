<?php

namespace App\Http\Controllers\Api;

use App\Repositories\BuggerRepositoryInterface;
use App\Transformers\BuggerTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Response as HTTP;

class BuggersController extends APIController
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
        try {
            $data = $this->buggers->all();
        }
        catch (\Exception $e) {
            return $this->abort(HTTP::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->respond($data, HTTP::HTTP_OK);
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
        try {
            $data = $this->buggers->find($id);
        }
        catch (ModelNotFoundException $e) {
            return $this->abort(HTTP::HTTP_NOT_FOUND, 'Could not locate requested bugger entry');
        }
        catch(\Exception $e) {
            return $this->abort(HTTP::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->respond($data, HTTP::HTTP_OK);
    }
}
