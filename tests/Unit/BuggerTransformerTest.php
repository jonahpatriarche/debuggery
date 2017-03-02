<?php

namespace Tests\Unit;

use App\Bugger;
use App\Transformers\BuggerTransformer;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class BuggerTransformerTest
 *
 * @group transform
 * @package Tests\Unit
 */
class BuggerTransformerTest extends TestCase
{
    /**
     * @test
     */
    public function it_transforms_error_log_with_class_and_stack_trace()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        $e = new \Exception;
        $msg = 'TestError in ' . get_class($this) . ': This is a test. Stack trace:' . $e->getTraceAsString();
        Log::error($msg);
        $transformer = new BuggerTransformer();
        $bugger = Bugger::where('message', $msg)->first();


        /** * * *
         * ACT  *
         * * * **/
        $data = $transformer->transform($bugger);

        /** * * *
         * TEST *
         * * * **/
        dump($data);

    }
}
