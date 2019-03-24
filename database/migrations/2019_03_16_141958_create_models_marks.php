<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelsMarks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_marks', function (Blueprint $table) {
            $table->integer('model_id')->unsigned();
            $table->integer('mark_id')->unsigned();

            $table->foreign('model_id')->references('id')->on('auto_models')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('mark_id')->references('id')->on('auto_marks')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_marks');
    }
}
