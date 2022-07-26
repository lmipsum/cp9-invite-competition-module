<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageSubmitValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_submit_values', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('page_submit_id')->index();
            $table->string('key', 45);
            $table->text('value');
            $table->timestamps();

            $table->unique(['page_submit_id', 'key']);
            $table->foreign('page_submit_id')->references('id')->on('page_submits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_submit_values');
    }
}
