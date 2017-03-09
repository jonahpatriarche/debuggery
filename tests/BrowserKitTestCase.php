<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

abstract class BrowserKitTestCase extends BaseTestCase
{
    use DatabaseTransactions;

    /**
     * The base URL of the application.
     *
     * @var string
     */
    public $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

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
