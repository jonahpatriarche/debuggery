<?php

namespace Tests\Feature;

use Tests\BrowserKitTestCase;

/**
 * Class TrackersTest
 * @group trackers
 * @package Tests\Acceptance
 */
class TrackersTest extends BrowserKitTestCase
{
    /**
     * @test
     */
    public function it_creates_a_new_tracker()
    {
        $this->visit('/trackers/1/create')
            ->seePageIs('/trackers/1/create');
            $this->type('New Tracker', 'name')
            ->check('dump');
        $this->check('clear-cache');
        $this->check('clear-config');
        $this->check('db-connection');
        $this->press('Submit');

        $this->seeInDatabase('trackers', ['name'=>'New Tracker', 'bugger_id' => 1]);
    }
}
