<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLopmonhocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lopmonhoc', function (Blueprint $table) {
            $table->increments('ma_lop_mh');
            $table->string('id_zoom');
            $table->string('pass_zoom');
            $table->string('phong_hoc');
            $table->string('ca_hoc');
            $table->string('thu');
            $table->string('host_key_zoom');
            $table->unsignedInteger('ma_mh');
            $table->foreign('ma_mh')->references('ma_mh')->on('monhoc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lopmonhoc');
    }
}
