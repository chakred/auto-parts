<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_inner', 100);
            $table->string('name_good', 100);
            $table->text('desc_good');
            $table->string('mark_good', 100);
            $table->string('country', 100);
            $table->float('cost');
            $table->float('profit');
            $table->float('discount');
            $table->string('currency');
            $table->float('quantity');
            $table->string('item');
            $table->integer('id_model');
            $table->integer('id_sub_category');
            $table->string('img_path')->nullable();
            $table->string('slug', 255)->default('');
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
        Schema::dropIfExists('goods');
    }
}
