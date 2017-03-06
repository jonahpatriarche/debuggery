<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackerStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracker_steps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tracker_id')->unsigned();
            $table->integer('step_number');
            $table->string('description');
            $table->string('notes')->nullable();
            $table->string('link')->nullable();
            $table->string('link_text')->nullable();
            $table->string('image')->nullable();
            $table->boolean('was_fix');
            $table->timestamps();

            $table->foreign('tracker_id')
                ->references('id')
                ->on('trackers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropForeign('tracker_steps_tracker_id_foreign');
        Schema::dropIfExists('tracker_steps');
    }
}
