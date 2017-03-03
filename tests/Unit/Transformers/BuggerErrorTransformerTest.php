<?php

namespace Tests\Unit;

use App\Bugger;
use App\Transformers\BuggerTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;


/**
 * Class BuggerErrorTransformerTest
 *
 * @group   transform
 * @group   error
 *
 * @package Tests\Unit
 */
class BuggerErrorTransformerTest extends BaseTransformerTest
{

    /**
     * @test
     */
    public function it_transforms_message_of_ModelNotFound_exception()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        $e = $this->logModelNotFoundException();

        $transformer = new BuggerTransformer();
        $bugger      = Bugger::orderBy('id', 'desc')
            ->first();

        /** * * *
         * ACT  *
         * * * **/
        try {
            $data = $transformer->transform($bugger);
        }
        catch (\Exception $e) {
            $this->failWithException($e); // exception = fail, yo
            return;
        }

        /** * * *
         * TEST *
         * * * **/
        $this->assertEquals($e->getMessage(), $data['message']);
    }

    /** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** **
     *                                                                                            **
     *                                          MISSING MESSAGE                                   **
     *                                                                                            **
     ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** **/

    /**
    * @group uut
     * @test
     */
    public function it_transforms_message_of_exception_error_with_blank_message_to_exception_class()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        // generate specified log components
        $class = \Exception::class;
        $file  =  get_class($this);
        $line  = 73;

        $this->createLogEntry('ERROR', $message = null, $class, $file, $line, $with_trace = true);

        $transformer = new BuggerTransformer();
        $bugger      = Bugger::orderBy('id', 'desc')
            ->first();

        /** * * *
         * ACT  *
         * * * **/
        try {
            $data = $transformer->transform($bugger);
        }
        catch (\Exception $e) {
            $this->failWithException($e); // exception = fail, yo
            return;
        }

        /** * * *
         * TEST *
         * * * **/
        $this->assertEquals(\Exception::class, $data['message']);
    }

    /** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** **
     *                                                                                            **
     *                                          MISSING STACK TRACE                               **
     *                                                                                            **
     ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** **/

    /**
     * Check if transformer fails with no stack trace
     *
     * @test
     */
    public function it_transforms_message_of_error_with_class_name_but_no_stack_trace()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        $this->writeLogWithNoStackTrace();

        $transformer = new BuggerTransformer();
        $bugger      = Bugger::orderBy('id', 'desc')
            ->first();

        /** * * *
         * ACT  *
         * * * **/
        try {
            $data = $transformer->transform($bugger);
        }
        catch (\Exception $e) {
            try {
                $data = $transformer->transform($bugger);
            }
            catch (\Exception $e) {
                $this->failWithException($e);

                return;
            }
        }

        /** * * *
         * TEST *
         * * * **/
        $this->assertEquals('This has no stack trace', $data['message']);
    }

    /** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** **
     *                                                                                            **
     *                                          MISSING CLASS NAME                                **
     *                                                                                            **
     ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** **/

    /**
     * Check if transformer fails with no class name
     *
     * @test
     */
    public function it_transforms_error_message_with_no_class_name()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        $message = $this->createLogEntry();



        $transformer = new BuggerTransformer();
        $bugger      = Bugger::orderBy('id', 'desc')
            ->first();

        /** * * *
         * ACT  *
         * * * **/
        try {
            $data = $transformer->transform($bugger);
        }
        catch (\Exception $e) {

            $this->failWithException($e); // exception = fail, yo
            return;
        }

        /** * * *
         * TEST *
         * * * **/
        $this->assertEquals($message, $data['message']);
    }

    private function writeLogWithNoStackTrace()
    {
        $message = 'ErrorTest: This has no stack trace';

        Log::error($message);
    }


}
