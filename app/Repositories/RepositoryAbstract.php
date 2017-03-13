<?php

namespace App\Repositories;

use Illuminate\Http\Request;


abstract class RepositoryAbstract
{

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Constructor
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
