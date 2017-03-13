<?php

namespace Tests\Feature;

use App\Bugger;
use App\Tracker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\BrowserKitTestCase;

/**
 * Class TrackersTest
 * @group trackers
 * @package Tests\Acceptance
 */
class TrackersTest extends BrowserKitTestCase
{

    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_creates_a_new_tracker()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        $bugger_id = factory(Bugger::class)->create()->id;

        /** * * *
         * ACT  *
         * * * **/
        $this->visit('/trackers/' . $bugger_id . '/create')
            ->seePageIs('/trackers/'. $bugger_id . '/create');

        $this->type('New Tracker', 'name')
            ->check('dump');
        $this->check('clear-cache');
        $this->check('clear-config');
        $this->check('db-connection');
        $this->press('Submit');

        /** * * *
         * TEST *
         * * * **/
        $this->seeInDatabase('trackers', ['name'=>'New Tracker', 'bugger_id' => $bugger_id]);
    }

    /**
     * @test
     */
    public function it_redirects_with_errors_if_invalid_bugger_id_used_to_create_tracker()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        $input = ['name' => 'Test tracker'];

        /** * * *
         * ACT  *
         * * * **/
        $this->post(route('trackers.store', ['bugger_id' => 666]), $input);

        /** * * *
         * TEST *
         * * * **/
        $this->assertSessionHasErrors('bugger_id');
        $this->assertRedirectedTo('/');
    }

    /**
     * @test
     */
    public function it_redirects_with_errors_if_deleted_bugger_id_used_to_create_tracker()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        $input = ['name' => 'Test tracker'];
        $bugger = factory(Bugger::class)->create();
        $bugger->delete();

        /** * * *
         * ACT  *
         * * * **/
        $this->post(route('trackers.store', ['bugger_id' => $bugger->id]), $input);

        /** * * *
         * TEST *
         * * * **/
        $this->assertSessionHasErrors('bugger_id');
        $this->assertRedirectedTo('/');
    }

    /**
     * @test
     */
    public function it_deletes_bugger_when_tracker_created()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        $bugger_id = factory(Bugger::class)->create()->id;

        /** * * *
         * ACT  *
         * * * **/
        $this->visit('/trackers/' . $bugger_id . '/create')
            ->seePageIs('/trackers/'. $bugger_id . '/create');

        $this->type('New Tracker', 'name');
        $this->check('dump');
        $this->check('clear-cache');
        $this->check('clear-config');
        $this->check('db-connection');
        $this->press('Submit');

        /** * * *
         * TEST *
         * * * **/
        $this->notSeeInDatabase('buggers', ['id' => $bugger_id, 'deleted_at' => null]);

    }

    /**
     * @test
     */
    public function it_finds_an_existing_tracker()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        $tracker = factory(Tracker::class)->create();

        /** * * *
         * ACT  *
         * * * **/
        $this->visit('/trackers/' . $tracker->bugger_id);

        /** * * *
         * TEST *
         * * * **/
        $this->seeJsonContains([
            'name'         => $tracker->name,
            'description'  => $tracker->description,
            'bugger_id'    => $tracker->bugger_id,
            'is_active'    => $tracker->is_active,
            'is_resolved'  => $tracker->is_resolved,
        ]);
    }

    /**
     * @test
     */
    public function it_lists_all_trackers()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        $num_trackers = Tracker::all()->count();

        /** * * *
         * ACT  *
         * * * **/
        $this->visit('/trackers');

        /** * * *
         * TEST *
         * * * **/
        $this->assertCount($num_trackers, $this->response->original);
    }
}
