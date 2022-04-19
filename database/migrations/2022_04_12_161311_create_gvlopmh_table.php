<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGvlopmhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gvlopmh', function (Blueprint $table) {
            $table->unsignedInteger('ma_lop_mh');
            $table->foreign('ma_lop_mh')->references('ma_lop_mh')->on('lopmonhoc');
            $table->unsignedInteger('ma_gv');
            $table->foreign('ma_gv')->references('ma_gv')->on('giangvien');
            $table->primary(['ma_lop_mh', 'ma_gv']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gvlopmh');
    }
}
