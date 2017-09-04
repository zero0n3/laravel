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
            //ID
            $table->increments('id');
            //NOMEMOC
            $table->string('namemoc',128);
            //USER_ID
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->on('lusers')->references('id')->onDelete('cascade')->onUpdate('cascade');
            //PART
            $table->string('part',20);
            $table->foreign('part')->on('lparts')->references('part_num');
            //COLOR
            $table->integer('color')->unsigned();
            $table->foreign('color')->on('lcolors')->references('col_num');
            //UNIQUE FIELDS
            $table->unique(array('user_id', 'part', 'color'));
            //QUANTITY
            $table->integer('quantity')->unsigned();
            //times
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
