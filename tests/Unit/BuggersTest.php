<?php

namespace Tests\Unit;

use App\Bugger;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class BuggersTest
 *
 * @group buggers
 */
class BuggersTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;


    /**
     * Test emergency-level bugger creation
     * @test
     */
    public function it_creates_emergency_level_bugger()
    {
        /** * * * *
         * SETUP  *
         * * * * **/

        // None required

        /** * * *
         * ACT  *
         * * * **/
        Log::emergency('EmergencyTest');

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

        // None required

        /** * * *
         * ACT  *
         * * * **/
        Log::alert('AlertTest');

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

        // None required

        /** * * *
         * ACT  *
         * * * **/
        Log::critical('CriticalTest');

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

        // None required

        /** * * *
         * ACT  *
         * * * **/
        Log::error('ErrorTest');

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

        // None required

        /** * * *
         * ACT  *
         * * * **/
        Log::warning('WarningTest');

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

        // None required

        /** * * *
         * ACT  *
         * * * **/
        Log::notice('NoticeTest');

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

        // None required

        /** * * *
         * ACT  *
         * * * **/
        Log::info('InfoTest');

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
