<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutoModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_models', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('auto_mark_id')->unsigned();
            $table->string('name_model');
            $table->integer('year')->nullable();
            $table->string('engine', 100);
            $table->string('type_of_engine')->nullable();
            $table->string('transmission');
            $table->string('type_of_transmission')->nullable();
            $table->string('img_path')->nullable();
            $table->string('slug', 255)->default('');

            $table->foreign('auto_mark_id')->references('id')->on('auto_marks')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auto_models');
    }
}
