<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFurtherSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('further_sub_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('further_sub_category', 100);
            $table->string('img_path')->nullable();
            $table->integer('id_sub_category');
            $table->string('slug', 255)->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('further_sub_categories');
    }
}
