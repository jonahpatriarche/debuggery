<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions;

    /**
     * Assert test fails and print error message and line
     *
     * @param \Exception $e
     */
    protected function failWithException(\Exception $e)
    {
        $this->assertTrue(
            false,
            'Transformer threw exception: ' . $e->getMessage() . ' at line ' . $e->getLine()
        );
    }
}
