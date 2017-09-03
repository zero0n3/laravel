<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lmocs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('namemoc',128);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->on('lusers')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->string('part',20);
            $table->foreign('part')->on('lparts')->references('part_num');
            $table->integer('color')->unsigned();
            $table->foreign('color')->on('lcolors')->references('col_num');
            $table->unique(array('user_id', 'part', 'color'));
            $table->integer('quantity')->unsigned();
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
        Schema::dropIfExists('lmocs');
    }
}
