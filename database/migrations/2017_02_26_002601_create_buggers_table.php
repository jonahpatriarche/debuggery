<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuggersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buggers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('log_id')
                ->unsigned();
            $table->string('name');
            $table->string('description');
            $table->boolean('resolved');

            $table->foreign('log_id')
                ->references('id')
                ->on('logs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buggers', function (Blueprint $table) {
            $table->dropForeign('buggers_log_id_foreign');
        });

        Schema::dropIfExists('buggers');
    }
}
