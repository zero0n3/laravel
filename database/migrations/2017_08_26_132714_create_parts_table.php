<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lparts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('part_num',20)->unique();
            $table->string('description',128);
            $table->integer('cat_id')->unsigned();
            $table->foreign('cat_id')->on('lcategories')->references('cat_num')->onUpdate('cascade');
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
        Schema::dropIfExists('lparts');
    }
}
