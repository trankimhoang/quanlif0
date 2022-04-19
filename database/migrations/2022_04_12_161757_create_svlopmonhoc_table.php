<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSvlopmonhocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('svlopmonhoc', function (Blueprint $table) {
            $table->unsignedInteger('ma_sv');
            $table->foreign('ma_sv')->references('ma_sv')->on('sinhvien');
            $table->unsignedInteger('ma_lop_mh');
            $table->foreign('ma_lop_mh')->references('ma_lop_mh')->on('lopmonhoc');
            $table->primary(['ma_sv', 'ma_lop_mh']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('svlopmonhoc');
    }
}
