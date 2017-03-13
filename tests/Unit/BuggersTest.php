<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Log;
use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class BuggersTest
 *
 * @group buggers
 */
class BuggersTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test emergency-level bugger creation
     * @test
     */
    public function it_creates_emergency_level_bugger()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        Log::emergency('EmergencyTest');

        /** * * *
         * ACT  *
         * * * **/
        // No action required

        /** * * *
         * TEST *
         * * * **/

        $this->assertDatabaseHas('buggers', [
            'message' => 'EmergencyTest',
            'level_name' => 'EMERGENCY'
        ]);
    }

    /**
     * Test alert-level bugger creation
     * @test
     */
    public function it_creates_alert_level_bugger()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        Log::alert('AlertTest');

        /** * * *
         * ACT  *
         * * * **/
        // No action required

        /** * * *
         * TEST *
         * * * **/
        $this->assertDatabaseHas('buggers', [
            'message' => 'AlertTest',
            'level_name' => 'ALERT'
        ]);
    }

    /**
     * Test critical-level bugger creation
     * @test
     */
    public function it_creates_critical_level_bugger()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        Log::critical('CriticalTest');

        /** * * *
         * ACT  *
         * * * **/
        // No action required

        /** * * *
         * TEST *
         * * * **/
        $this->assertDatabaseHas('buggers', [
            'message' => 'CriticalTest',
            'level_name' => 'CRITICAL'
        ]);
    }

    /**
     * Test error-level bugger creation
     * @test
     */
    public function it_creates_error_level_bugger()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        Log::error('ErrorTest');

        /** * * *
         * ACT  *
         * * * **/
        // No action required

        /** * * *
         * TEST *
         * * * **/
        $this->assertDatabaseHas('buggers', [
            'message' => 'ErrorTest',
            'level_name' => 'ERROR'
        ]);
    }

    /**
     * Test warning-level bugger creation
     * @test
     */
    public function it_creates_warning_level_bugger()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        Log::warning('WarningTest');

        /** * * *
         * ACT  *
         * * * **/
        // No action required

        /** * * *
         * TEST *
         * * * **/
        $this->assertDatabaseHas('buggers', [
            'message' => 'WarningTest',
            'level_name' => 'WARNING'
        ]);
    }

    /**
     * Test notice-level bugger creation
     * @test
     */
    public function it_creates_notice_level_bugger()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        Log::notice('NoticeTest');

        /** * * *
         * ACT  *
         * * * **/
        // No action required

        /** * * *
         * TEST *
         * * * **/
        $this->assertDatabaseHas('buggers', [
            'message' => 'NoticeTest',
            'level_name' => 'NOTICE'
        ]);
    }

    /**
     * Test info-level bugger creation
     * @test
     */
    public function it_creates_info_level_bugger()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        Log::info('InfoTest');

        /** * * *
         * ACT  *
         * * * **/
        // No action required

        /** * * *
         * TEST *
         * * * **/
        $this->assertDatabaseHas('buggers', [
            'message' => 'InfoTest',
            'level_name' => 'INFO'
        ]);
    }

    /**
     * Test debug-level bugger creation
     * @test
     */
    public function it_creates_debug_level_bugger()
    {
        /** * * * *
         * SETUP  *
         * * * * **/

        // None required

        /** * * *
         * ACT  *
         * * * **/
        Log::debug('DebugTest');

        /** * * *
         * TEST *
         * * * **/
        $this->assertDatabaseHas('buggers', [
            'message' => 'DebugTest',
            'level_name' => 'DEBUG'
        ]);
    }
}
