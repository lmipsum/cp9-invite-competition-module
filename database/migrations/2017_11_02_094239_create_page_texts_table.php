<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_texts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('page_id')->index();
            $table->string('name', 45);
            $table->string('key', 45);
            $table->text('value')->nullable();
            $table->timestamps();

            $table->unique(['page_id', 'key']);
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_texts');
    }
}
