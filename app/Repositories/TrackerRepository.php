<?php

namespace App\Repositories;

use App\Bugger;
use App\Tracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackerRepository extends RepositoryAbstract implements TrackerRepositoryInterface
{

    /**
     * TrackerRepository constructor.
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    /**
     * Return a collection of all trackers in storage
     *
     * @return mixed
     */
    public function all()
    {
        return Tracker::with('steps')
            ->all();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function find($id)
    {
        return Tracker::with('steps')
            ->findOrFail($id);
    }

    /**
     * Save and return a new Tracker model
     *
     * @return \App\Tracker
     * @throws \Exception
     */
    public function save()
    {
        DB::beginTransaction();

        try {
            $input   = array_except($this->request->input(), ['_token', '_method']);
            $tracker = Tracker::create($input);
        }
        catch(\Exception $e) {
            DB::rollback();

            throw $e;
        }

        DB::commit();

        return $tracker;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
