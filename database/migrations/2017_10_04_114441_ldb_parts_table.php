<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LdbPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ldb_part', function (Blueprint $table) {
            //ID
            $table->increments('id');
            //id_db
            $table->integer('db_id')->unsigned();
            $table->foreign('db_id')->on('ldb_lego_user')->references('id')->onDelete('cascade')->onUpdate('cascade');
            //USER_ID
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->on('lusers')->references('id')->onDelete('cascade')->onUpdate('cascade');
            //PART
            $table->string('part',20);
            $table->foreign('part')->on('lparts')->references('part_num');
           //COLOR
            $table->integer('color')->unsigned();
            $table->foreign('color')->on('lcolors')->references('col_num');
            //UNIQUE
            $table->unique(array('user_id', 'part', 'color'));
            //QUANTITY
            $table->integer('quantity');
            //time
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
        Schema::dropIfExists('ldb_part');
    }
}
