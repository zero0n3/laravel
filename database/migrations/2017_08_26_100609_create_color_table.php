<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lcolors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('col_num')->unsigned()->unique();
            $table->string('color_name',128);
            $table->string('rgb',6);
            $table->string('trasp',4);
            $table->softDeletes();
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
        Schema::dropIfExists('lcolors');
    }
}
