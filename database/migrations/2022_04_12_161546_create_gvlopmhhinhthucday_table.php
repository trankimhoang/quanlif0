<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGvlopmhhinhthucdayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gvlopmhhinhthucday', function (Blueprint $table) {
            $table->unsignedInteger('ma_gv');
            $table->foreign('ma_gv')->references('ma_gv')->on('giangvien');
            $table->unsignedInteger('ma_lop_mh');
            $table->foreign('ma_lop_mh')->references('ma_lop_mh')->on('lopmonhoc');
            $table->unsignedInteger('ma_ht');
            $table->foreign('ma_ht')->references('ma_ht')->on('hinhthucday');
            $table->date('tu_ngay');
            $table->date('den_ngay');
            $table->primary(['ma_gv', 'ma_lop_mh', 'ma_ht']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gvlopmhhinhthucday');
    }
}
