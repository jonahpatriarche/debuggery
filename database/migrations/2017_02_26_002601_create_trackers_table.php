<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bugger_id')->unsigned();
            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_resolved')->default(false);
            $table->timestamps();

            $table->foreign('bugger_id')
                ->references('id')
                ->on('buggers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trackers', function(Blueprint $table) {
            $table->dropForeign('trackers_bugger_id_foreign');
        });

        Schema::dropIfExists('trackers');
    }
}
