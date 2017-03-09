<?php

namespace App\Repositories;

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
            ->get();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function find($id)
    {
        return Tracker::with('steps')
            ->where('bugger_id', $id)
            ->firstOrFail();
    }

    /**
     * Save and return a new Tracker model
     *
     *   - after tracker is created, soft-delete the associated Bugger model
     *     so that it no longer appears in the bugger list
     *
     * @return \App\Tracker
     * @throws \Exception
     */
    public function save()
    {
        DB::beginTransaction();

        try {
            $input   = $this->request->input();
            $tracker = Tracker::create($input);
            $tracker->bugger->delete();
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
