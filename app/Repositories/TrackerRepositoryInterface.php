<?php

namespace App\Repositories;

interface LogRepositoryInterface
{

    /**
     * Return a collection of all logs in storage
     *
     * @return mixed
     */
    public function all();

    /**
     * Save a new log file in storage
     *
     * @return mixed
     */
    public function upload();

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
