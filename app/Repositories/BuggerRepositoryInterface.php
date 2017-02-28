<?php

namespace App\Repositories;

interface BuggerRepositoryInterface
{

    /**
     * Return a collection of all buggers in storage
     *
     * @return mixed
     */
    public function all();

    /**
     * Save a new bugger file in storage
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
