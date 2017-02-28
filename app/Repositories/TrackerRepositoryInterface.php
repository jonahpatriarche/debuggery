<?php

namespace App\Repositories;

interface TrackerRepositoryInterface
{

    /**
     * Return a collection of all trackers in storage
     *
     * @return mixed
     */
    public function all();

    /**
     * @param $id
     *
     * @return mixed
     */
    public function find($id);

    /**
     * @param $id
     *
     * @return mixed
     */
    public function delete($id);
}
