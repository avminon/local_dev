<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Results extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('set_id')->unsigned();
            $table->foreign('set_id')
                ->references('id')->on('sets')
                ->onDelete('cascade');
            $table->integer('term_id')->unsigned();
            $table->foreign('term_id')
                ->references('id')->on('terms')
                ->onDelete('cascade');
            $table->string('result');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('results');
    }
}
