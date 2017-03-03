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
            $table->text('message');
            $table->integer('level');
            $table->string('level_name');
            $table->string('context')->nullable();
            $table->string('extra')->nullable();
            $table->text('formatted');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buggers');
    }
}
