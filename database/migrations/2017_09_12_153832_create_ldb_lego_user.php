<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLdbLegoUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ldb_lego_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_db',128);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->on('lusers')->references('id')->onDelete('cascade')->onUpdate('cascade');  
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
         Schema::dropIfExists('ldb_lego_user');
    }
}
