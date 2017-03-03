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
     * @todo - implement
     */
    public function it_transforms_date()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        $message = 'Testing error date transformation';
        $class   = \Exception::class;
        $file    = get_class($this);
        $line    = 300;
        $this->createLogEntry('ERROR', $message, $class, $file, $line, $with_trace = true);

        $transformer = new BuggerTransformer();
        $bugger      = Bugger::orderBy('id', 'desc')->first();

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

    }

    /**
     * @test
     */
    public function it_transforms_bugger_id()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        $message = 'Testing error date transformation';
        $class   = \Exception::class;
        $file    = get_class($this);
        $line    = 300;
        $this->createLogEntry('ERROR', $message, $class, $file, $line, $with_trace = true);

        $transformer = new BuggerTransformer();
        $bugger      = Bugger::orderBy('id', 'desc')->first();

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
        $this->assertArrayHasKey('bugger_id', $data);
        $this->assertEquals($data['bugger_id'], $bugger->id);
    }

    /**
     * @test
     */
    public function it_transforms_level_name_of_error_log()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        $message = 'Testing error date transformation';
        $class   = \Exception::class;
        $file    = get_class($this);
        $line    = 300;
        $this->createLogEntry('ERROR', $message, $class, $file, $line, $with_trace = true);

        $transformer = new BuggerTransformer();
        $bugger      = Bugger::orderBy('id', 'desc')->first();

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
        $this->assertArrayHasKey('level_name', $data);
        $this->assertEquals($data['level_name'], 'error');
    }

    /**
     * @test
     */
    public function it_transforms_level_icon_of_error_log()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        $message = 'Testing error date transformation';
        $class   = \Exception::class;
        $file    = get_class($this);
        $line    = 300;
        $this->createLogEntry('ERROR', $message, $class, $file, $line, $with_trace = true);

        $transformer = new BuggerTransformer();
        $bugger      = Bugger::orderBy('id', 'desc')->first();

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
        $this->assertArrayHasKey('level_icon', $data);
        $this->assertEquals($data['level_icon'], $bugger->getLevelIcon());
    }

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
        $bugger      = Bugger::orderBy('id', 'desc')->first();

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
     * @test
     */
    public function it_transforms_missing_message_of_error_to_error_class()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        $class = \Exception::class;
        $file  = get_class($this);
        $line  = 73;

        $this->createLogEntry('ERROR', $message = null, $class, $file, $line, $with_trace = true);

        $transformer = new BuggerTransformer();
        $bugger      = Bugger::orderBy('id', 'desc')->first();

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

    /**
    * @group uut
     * @test
     */
    public function it_transforms_error_class_of_error_log_with_blank_message()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        $class = \Exception::class;
        $file  = get_class($this);
        $line  = 73;

        $this->createLogEntry('ERROR', $message = null, $class, $file, $line, $with_trace = true);

        $transformer = new BuggerTransformer();
        $bugger      = Bugger::orderBy('id', 'desc')->first();

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
        $this->assertArrayHasKey('error_class', $data);
        $this->assertEquals($class, $data['error_class']);
    }

    /**
     * @test
     */
    public function it_transforms_file_of_error_log_with_blank_message()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        $class = \Exception::class;
        $file  = get_class($this);
        $line  = 73;

        $this->createLogEntry('ERROR', $message = null, $class, $file, $line, $with_trace = true);

        $transformer = new BuggerTransformer();
        $bugger      = Bugger::orderBy('id', 'desc')->first();

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
        $expected = $file . ':' . $line;
        $this->assertArrayHasKey('file', $data);
        $this->assertEquals($expected, $data['file']);
    }

    /**
     * @test
     */
    public function it_transforms_trace_of_error_log_with_blank_message()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        $class = \Exception::class;
        $file  = get_class($this);
        $line  = 73;

        $this->createLogEntry('ERROR', $message = null, $class, $file, $line, $with_trace = true);

        $transformer = new BuggerTransformer();
        $bugger      = Bugger::orderBy('id', 'desc')->first();

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
        $this->assertArrayHasKey('trace', $data);
        $this->assertNotEmpty($data['trace']);
        $this->assertTrue(is_array($data['trace']));
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
    public function it_transforms_message_of_error_log_with_no_stack_trace()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        $message = 'Testing error log with no trace';
        $class   = \Exception::class;
        $file    = get_class($this);
        $line    = 10;

        $this->createLogEntry('ERROR', $message, $class, $file, $line, $with_trace = false);

        $transformer = new BuggerTransformer();
        $bugger      = Bugger::orderBy('id', 'desc') ->first();

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
        $this->assertEquals($message, $data['message']);
    }

    /**
     * @todo - implement
     */
    public function it_transforms_error_class_of_error_log_with_no_stack_trace()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        $message = 'Testing error log with no trace';
        $class   = \Exception::class;
        $file    = get_class($this);
        $line    = 10;

        $this->createLogEntry('ERROR', $message, $class, $file, $line, $with_trace = false);

        $transformer = new BuggerTransformer();
        $bugger      = Bugger::orderBy('id', 'desc') ->first();

        /** * * *
         * ACT  *
         * * * **/

        /** * * *
         * TEST *
         * * * **/

    }

    /**
     * @todo - implement
     */
    public function it_transforms_file_of_error_log_with_no_stack_trace()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        $message = 'Testing error log with no trace';
        $class   = \Exception::class;
        $file    = get_class($this);
        $line    = 10;

        $this->createLogEntry('ERROR', $message, $class, $file, $line, $with_trace = false);

        $transformer = new BuggerTransformer();
        $bugger      = Bugger::orderBy('id', 'desc') ->first();

        /** * * *
         * ACT  *
         * * * **/

        /** * * *
         * TEST *
         * * * **/

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
        $message = 'Testing error log with no class name';
        $file    = get_class($this);
        $line    = 300;
        $this->createLogEntry('ERROR', $message, $class = null, $file, $line, $with_trace = true);

        $transformer = new BuggerTransformer();
        $bugger      = Bugger::orderBy('id', 'desc')->first();

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

    /**
     * @todo - implement
     */
    public function it_transforms_missing_error_class_of_error_log_to_level_name()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        $message = 'Testing error log with no class name';
        $file    = get_class($this);
        $line    = 300;
        $this->createLogEntry('ERROR', $message, $class = null, $file, $line, $with_trace = true);

        $transformer = new BuggerTransformer();
        $bugger      = Bugger::orderBy('id', 'desc')->first();

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

    }

    /**
     * @todo - implement
     */
    public function it_transforms_file_of_error_log_with_no_class_name()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        $message = 'Testing error log with no class name';
        $file    = get_class($this);
        $line    = 300;
        $this->createLogEntry('ERROR', $message, $class = null, $file, $line, $with_trace = true);

        $transformer = new BuggerTransformer();
        $bugger      = Bugger::orderBy('id', 'desc')->first();

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

    }

    /**
     * @todo - implement
     */
    public function it_transforms_trace_of_error_log_with_no_class_name()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        $message = 'Testing error log with no class name';
        $file    = get_class($this);
        $line    = 300;
        $this->createLogEntry('ERROR', $message, $class = null, $file, $line, $with_trace = true);

        $transformer = new BuggerTransformer();
        $bugger      = Bugger::orderBy('id', 'desc')->first();

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

    }
}
